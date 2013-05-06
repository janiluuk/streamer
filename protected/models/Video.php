<?php

Yii::import('application.models._base.BaseVideo');
Yii::import('application.components.videotoolkit');


class Video extends BaseVideo
{
    const RTMP_LINK = "rtmp://citystream.tv/vod/";
    /**
     * @return Video
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Video|Videot', $n);
    }
    
    public function getLink() {
            return "/files/" . basename($this->filename);
    }


    public function importVideoFile($file, $user_id) {
     
	$file = str_replace("//", "/", $file);

	if (!file_exists($file)) {
	  throw new Exception("Video {$file} not found");

	}
	$old_file = basename($file);

	$new_file = str_replace(".flv", "", str_replace(".mov", "", str_replace(".mp4", "", strtolower(basename($file))))) . ".mp4";
	$new = str_replace($old_file, $new_file, $file);
	if ($file != $new) shell_exec('mv "' .$file .'" "' .$new . '"');
	if (file_exists($new)) $file = $new;
	error_log("Searching for {$file}");
	if (!$video = Video::model()->find("filepath = '" . $file ."'")) {
	error_log("Importing $file");	  
	$video = new Video();
	$video->filepath = $file;
	if ($video->getFileProperties()) {
	  if ($video->status != 1) {
	    $video->user_id = $user_id;
	    $video->getThumbnail();
	    $video->status = 1;
	    
	    $video->save();
	    //	    $video->convert();
	  }

	}
	} else {
	  return false;
	}

	return true;
   }  
    public function processQueue() {

      $videos = Video::model()->findAll("status=1");
      foreach ((array)$videos as $video) {
	$video->convert();

      }


    }
    /*
     * Get videofile properties through videotoolkit
     * @params string $file filename
     * @return array file properties or false
     */
    public function convert() { 
      $path = $this->filepath;
      $dir = dirname($path);


      $new_file = $dir . "/800/" . str_replace(".mp4", "-800.mp4", basename($path));
      if (file_exists($path)) {
	$this->status = 3;
	$this->save();
	foreach ($this->getBitrates() as $br) {
	$cmd = "/usr/local/bin/convert.sh \"$path\" " . $br . " 1280:720";
	shell_exec($cmd);
	}

	if (file_exists($new_file)) {
	$this->status = 2;

	$this->save();
	return true;
	} else {
	  error_log("Could not convert $path");
	  return false;
	}


      }
      else throw new Exception($path . " does not exist!");

    }
    public static function getStatus($s="") {
      $status = array("2" => "<span class=\"badge badge-success\">Valmis</span>",
		      "1" => "<span class=\"badge badge-info\">Jonossa</span>",
		      "3" => "<span class=\"badge badge-important\">K&auml;sittelyss&auml;</span>",
		      );
      if (empty($s)) return array("2"=>"Valmis","3" => "Kasittelyssa", "1" => "Jonossa");

      if (!empty($status[$s])) return $status[$s];
    }

    public function getFileProperties() {
        $toolkit = new videotoolkit();
	if (file_exists($this->filepath)) {

        if ($info = $toolkit->getInfo($this->filepath)) {

	  if (is_array($info["duration"]["timecode"])) $this->length = $info["duration"]["timecode"]["rounded"];
	  $this->bitrate = $info["bitrate"];
	  $this->filesize = filesize($this->filepath);
	  $this->filename = basename($this->filepath);
	  $this->video_container = substr($this->filename, strrpos($this->filename, '.'));
	  $this->video_width = $info["video"]["dimensions"]["width"];
	  $this->video_height = $info["video"]["dimensions"]["height"];
	  $this->framerate = $info["video"]["frame_rate"];
	  $this->video_codec = $info["video"]["codec"];
	  $this->audio_samplerate = $info["audio"]["sample_rate"];
	  $this->audio_codec = $info["audio"]["codec"];
	  return $info;
        }

	}
    }

	public function getThumbnail() {
	  $toolkit = new videotoolkit();

	  $url = $toolkit->generateThumbnail($this->filepath);
	  $this->thumbnail_url = $url;


	}

    /*
     * Return a filename that is relative to the root directory of the RTMP service
     *
     */

    public function getRtmpLink() {
      
      $prefix="/files/";

      $filename = basename($this->filename);
      $parts = explode("_", basename($this->filename));

      //      $profile = str_replace(".mp4", "", strtolower(array_pop($parts)));
      
      $dir = $this->user->username;
      return $prefix . "" . $dir  . "/Videot/" . $filename;

      
    }   

}