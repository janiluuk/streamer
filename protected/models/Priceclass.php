<?php

Yii::import('application.models._base.BasePriceclass');

class Priceclass extends BasePriceclass
{
  const FREE = 1;
  const VOD = 2;
  const SVOD_DAY = 3;
  const SVOD_WEEK = 4;
  const SVOD_MONTH = 5;
  const SVOD_YEAR = 6;
    /**
     * @return Priceclass
     */
  public static function getType($type=0) {
    
    $array = self::getTypes();
    foreach ((array)$array as $arr) {
      if ($arr["id"] == $type) return $arr["name"];
    }
    return false;

  }

  public static function getDuration($type=0) {
    
    $array = self::getTypes();
    foreach ((array)$array as $arr) {
      if ($arr["id"] == $type) return $arr["duration"];
    }
    return false;

  }


  public static function getTypes() {
    
    $array = array(array("id" => self::FREE, "name" => "Ilmainen", "duration" => 0),
		   array("id" => self::VOD, "name" => "Kertamaksu", "duration" => 60*60*24*999),
		   array("id" => self::SVOD_DAY, "name" => "Päivä",  "duration" => 60*60*24*1),
		   array("id" => self::SVOD_WEEK, "name" => "Viikko", "duration" => 60*60*24*7),
		   array("id" => self::SVOD_MONTH, "name" => "Kuukausi","duration" => 60*60*24*30),
		   array("id" => self::SVOD_YEAR, "name" => "Vuosi", "duration" =>60*60*24*365));


    return $array;

  }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Priceclass|Priceclasses', $n);
    }

}