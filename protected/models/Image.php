<?php

Yii::import('application.models._base.BaseImage');

class Image extends BaseImage
{
    /**
     * @return Image
     */
  public function getAllImages() {

    $user = Yii::app()->user->data()->username;
    $path = "/files/" . $user . "/Taustakuvat";
    $dir = "/www/citystream" . $path;
    if ($handle = opendir($dir)) {
		  while (false !== ($entry = readdir($handle))) {
		    if ($entry != "." && $entry != "..") {
		      $entries[] = $entry;
		    }
		  }
		  closedir($handle);
       }
    foreach ((array)$entries as $entry) {

      $images[] = $path . "/" . $entry;

    }
    return $images;

  }
  public function getAllLogos() {

    $user = Yii::app()->user->data()->username;
    $path = "/files/" . $user . "/Logot";
    $dir = "/www/citystream" . $path;
    if ($handle = opendir($dir)) {
		  while (false !== ($entry = readdir($handle))) {
		    if ($entry != "." && $entry != "..") {
		      $entries[] = $entry;
		    }
		  }
		  closedir($handle);
       }
    foreach ((array)$entries as $entry) {

      $images[] = $path . "/" . $entry;

    }
    return $images;

  }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Image|Images', $n);
    }

}