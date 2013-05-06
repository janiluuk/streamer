<?php

Yii::import('application.models._base.BaseChannel');

class Channel extends BaseChannel
{
    /**
     * @return Channel
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Channel|Channels', $n);
    }

    public static function getStatusList() {

      return array(
		   "0" => "Pois",
		   "1" => "Soittolista",
		   "2" => "Suora lähetys ",

		   );
      
    }
    public function getSdp() {

      $playlist = $this->playlist;
      $playlist_filename = str_replace(" ", "_", $playlist->playlist_name) . ".m3u";
      $basename = basename($playlist_filename);
      $basename_parts = explode(".", $basename);
      $sdp = $this->id . "_" . $basename_parts[0] . ".sdp";
      
      return $sdp;


    }

    public function getUrl() {

      return "http://" . $this->identifier . ".citystream.tv";
    }


    public function checkAccess() {

      if ($this->priceclass->type == Priceclass::FREE) return true;
      
      $value = isset(Yii::app()->request->cookies[$this->identifier]) ? Yii::app()->request->cookies[$this->identifier]->value : '';
      

      if (empty($value) && isset($_SESSION[$this->identifier])) $value = $_SESSION[$this->identifier];
      if (empty($value) && isset($_REQUEST["code"])) $value = $_REQUEST["code"];


      if (!empty($value)) {

	if (!$order = Order::model()->find("code=:code", array("code" => $value))) return false;
	return $order->isValid();

      } else {
	

      }
      return false;

    }

    public function addAccess($order) {
      if ($order->isValid()) {
	$cookie = new CHttpCookie($this->identifier, $order->code, array("domain" => 'citystream.tv'));
	  $cookie->expire = strtotime($order->valid_to);
	  $cookie->httpOnly = false;
	  $_SESSION[$this->identifier] = $order->code;

	  Yii::app()->request->cookies[$this->identifier] = $cookie;

      return true;
      }
      return false;
    }

    public function start() {
      $channel_id = $this->id;
      $id = $this->id;
      $user = $this->user;
      $username = $user->username;
      $this->stop();

       $playlist = $this->playlist;
       $port = $id*8+10000;
       $audio = $port+2;
       $playlist_filename = str_replace(" ", "_", $playlist->playlist_name) . ".m3u";
       $playlist->generatePlaylistFile($username);

       $playlist_file = "/www/citystream/files/" . $username . "/Soittolistat/" . $playlist_filename;
       $basename = basename($playlist_file);
       $basename_parts = explode(".", $basename);
       $sdp = $this->getSdp();

       $cmd = 'SUDO_UID=1 screen -dmS '.  $basename_parts[0] . ' vlc-wrapper ' . $playlist_file . ' --loop  --sout="#duplicate{dst=rtp{dst=5.9.60.140,port-video=' . $port . ',port-audio=' . $audio . ',sdp=file:///usr/local/WowzaMediaServer/content/' . $sdp .'}}"';
       //       shell_exec($cmd);
       $this->status = 1;
      $this->save();

       


    }


     public function stop() {


       $user = $this->user;
       $username = $user->username;
       
       $playlist = $this->playlist;
       $id = $this->id;
       $port = $id*8+10000;
       $audio = $port+2;
       $playlist_filename = str_replace(" ", "_", $playlist->playlist_name) . ".m3u";
       $playlist->generatePlaylistFile($username);

       $playlist_file = "/www/citystream/files/" . $username . "/Soittolistat/" . $playlist_filename;
       $basename = basename($playlist_file);
       $basename_parts = explode(".", $basename);

       $cmd = 'ps axu | grep "dst=5.9.60.140,port-video=' . $port . ',port-audio=' . $audio . '"';
       $output = shell_exec($cmd);
       

       foreach ((array)explode("\n", $output) as $line) {
	 $parts = explode(" ", $line);
	 $pid = $parts[1];
	 if (empty($pid)) $pid = $parts[2];
	 shell_exec("kill -9 {$pid}");



       }

       $shell_cmd = "screen  -S " . $basename_parts[0] . " kill";
       $this->status = 0;
       $this->save();

       shell_exec($shell_cmd);

     }


}