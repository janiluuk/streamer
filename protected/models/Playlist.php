<?php

Yii::import('application.models._base.BasePlaylist');

class Playlist extends BasePlaylist
{
    /**
     * @return Playlist
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Soittolista|Soittolistat', $n);
    }


    public function generatePlaylistFile($user="") {
      if (!$user) $username = Yii::app()->user->data()->username;
      else $username = $user;

      $filename = str_replace(" ", "_", $this->playlist_name . ".m3u");
      $filepath = "/www/citystream/files/" . $username .  "/Soittolistat/" . $filename;
      $videos = "";
    foreach ($this->Items as $item) {

    
	$videos .= $item->video->filepath . "\n";
	
	
    }
    if (empty($videos)) $videos ="";
    file_put_contents($filepath, $videos);
    return $filepath;


   }   

    public function getCurrentPosition() {

      $startPoint = strtotime($this->Channel->created_at);

      $currentTime = time();

      $time = $currentTime-$startPoint;
      
      return $time;
      

    }

    public function getPlaylistItems() {

      $playlist_length = 0;

      $items = $this->Items;
      foreach ($items as $key => $item) {
	$length = $item->video->length;
	$item_length = 0;
	$parts = explode(":", $length);
	$item_length += $parts[2];
	$item_length += (60*$parts[1]);
	$item_length += 60*(60*$parts[0]);
	$items[$key] = $item_length;
	$playlist_length += $item_length;
      }
      $array["playlist_length"] = $playlist_length;
      $array["items"] = $items;
	return $array;
    }
    
    public function getPlaylistPosition() {

      $items = $this->getPlaylistItems();
      $total_length = $items["playlist_length"];

      if ((int)$total_length < 1)       return array("items" => "", 'time' => 0);

      $time = $this->getCurrentPosition();
      
      while ($time > $total_length) {
	
	$time -= $total_length;

      }
      $list = $items["items"];
      $list_len = sizeof($items["items"]);
      $i = 0;


      while ($time > 0) {
	if ($i == $list_len) $i = 0;
	$item = $list[$i];
	if ($time < $item) { $current_item = $i; $current_time = $time; }
	$time -= $item;
	$i++;
      }
      $i = 0;
      foreach ($this->Items as $item) {
        if ($i >= $current_item) $final_items[] = $item;
	else $pre_items[] = $item;
	$i++;
      }
      foreach ((array)$pre_items as $item) {
	$final_items[] = $item;

      }
      foreach ((array)$final_items as $item) {
	$path = str_replace("/www/citystream", "", str_replace("/Videot/", "/Videot/800/", str_replace(".mp4", "-800.mp4", $item->video->filepath)));
	if (!file_exists("/www/citystream" . $path)) $path = str_replace("/Videot/800", "/Videot", str_replace("-800", "", $path));

	$playlist_items .=  $comma . "{title:'" . $item->video->title . "', url: 'mp4:" . str_replace(".mp4", "", $path) . "'}";
	$comma = ",";	
      }



      $playlist_items .= "}";
      $playlist_item = str_replace("}}",",onBeforeFinish: function() {return false;}}", $playlist_items);

      
      return array("items" => $playlist_item, 'time' => $current_time);



    }

}