<?php

class ChannelCommand extends CConsoleCommand {
    private $do_clean=false;
    private $overwrite = false;
    private $move_missing = false;
    public function showUsage()
    {
echo <<<USAGE
\033[1;1mNAME\033[1;m
\tChannel
\033[1;1mDESCRIPTION\033[1;m
\t-l --list list all channels
\t-s --start init channel [ID] 
\t-r --restart restart all channels
\t-x --stop stop channel [ID]
\r
USAGE;
			 }
    /// @TODO Build Argument Handler, -cdb should work too
    public function run($args)
    {

      
      if(in_array('-l',$args) || in_array('--list',$args))
        $this->listChannels();

      elseif(in_array('-r',$args) || in_array('--restart',$args)) {
	$this->stopAll();
	$this->startAll();
      }

      elseif(in_array('-s',$args) || in_array('--start',$args)) {
	if (!empty($args[1]))$channel_id= $args[1];

	if (empty($channel_id)) {
        $this->showUsage();
       
	} else {
	  
	  $this->initChannel($channel_id);
	}
      }
      elseif(in_array('--stop',$args) || in_array('-x', $args)) {
	if (!empty($args[1]))$channel_id= $args[1];

	if (empty($channel_id)) {
        $this->showUsage();
       
	} else {
	  
	  $this->stopChannel($channel_id);
	}

      }  elseif(in_array('-t',$args) || in_array('--test',$args)) {
	if (!empty($args[1]))$channel_id= $args[1];
	$this->testChannel($channel_id);

      } elseif(isset($args['help']) || isset($args['?']) || !count($args))
        $this->showUsage();
      else {
      $this->showUsage();
      }

    }

     public function listChannels() {
       
       $channels = Channel::model()->findAll();
       
       foreach ($channels as $channel) {

	 echo $channel->name  . " - "  . $channel->status . "\n";


       }


     }


     public function getDir($dir) {

       if ($handle = opendir($dir)) {
		  while (false !== ($entry = readdir($handle))) {
		    if ($entry != "." && $entry != "..") {
		      $entries[] = $entry;
		    }
		  }
		  closedir($handle);
       }
       return $entries;

     }


     public function stopAll() {

       shell_exec("killall -9 vlc");

     }

     public function startAll() {

       $channels = Channel::model()->findAll("status=1");

       foreach ((array)$channels as $channel) {

	 $channel->start();


       } 

     }

     public function initChannel($channel_id) {

       $channel = Channel::model()->findByPk($channel_id);
       $user = $channel->user;
       $username = $user->username;
       $this->stopChannel($channel_id);

       $playlist = $channel->playlist;
       $id = $channel->id;
       $port = $id*2+10000;
       $audio = $port+1;
       $playlist_filename = str_replace(" ", "_", $playlist->playlist_name) . ".m3u";
       $playlist->generatePlaylistFile($username);

       $playlist_file = "/www/citystream/files/" . $username . "/Soittolistat/" . $playlist_filename;
       $basename = basename($playlist_file);
       $basename_parts = explode(".", $basename);
       $sdp = $basename_parts[0] . ".sdp";
       $cmd = 'SUDO_UID=1 screen -dmS '.  $basename_parts[0] . '  vlc-wrapper ' . $playlist_file . ' --repeat --sout="#duplicate{dst=rtp{dst=5.9.60.140,port-video=' . $port . ',port-audio=' . $audio . ',sdp=file:///usr/local/WowzaMediaServer/content/' . $sdp .'}}"';


       shell_exec($cmd);
       
       echo $channel->name . " started\n";

     }
     public function testChannel($channel_id) {

       $channel = Channel::model()->findByPk($channel_id);
       $playlist = $channel->playlist;
       $pos = $playlist->getPlaylistPosition();
       
       var_dump($pos);


     }
     public function stopChannel($channel_id) {
       $channel = Channel::model()->findByPk($channel_id);
       $user = $channel->user;
       $username = $user->username;
       
       $playlist = $channel->playlist;
       $id = $channel->id;
       $port = $id*2+10000;
       $audio = $port+1;
       $playlist_filename = str_replace(" ", "_", $playlist->playlist_name) . ".m3u";
       $playlist->generatePlaylistFile($username);

       $playlist_file = "/www/citystream/files/" . $username . "/Soittolistat/" . $playlist_filename;
       $basename = basename($playlist_file);
       $basename_parts = explode(".", $basename);

       $shell_cmd = "screen  -S " . $basename_parts[0] . " kill";
       
       shell_exec($shell_cmd);
       echo $channel->name . " stopped\n";

     }

     public function getUsers() {
       $dir = Yii::app()->params["contentPath"];
       $users = $this->getDir($dir);
       return $users;

     }
     public function importContent() {


       $users = $this->getUsers();

       
       foreach ((array)$users as $user) {

	 if (!$username = YumUser::model()->find('username="' . $user . '"')) {

	   continue;
	 }
	 $uid = $username->id;
	 $dir = Yii::app()->params["contentPath"] . "/" . $username->username . "/" . "Videot";
	 
	 $entries = $this->getDir($dir);
	 
	 foreach ($entries as $entry) {
	   $vid = $dir . "/" . $entry;
	   Video::model()->importVideoFile($vid, $uid);
	 }

       }       



     }

     }
     