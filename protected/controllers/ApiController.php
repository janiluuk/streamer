<?php

class ApiController extends AweController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/api';

public function filters() {
	return array(
		     //		     			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view','watch'),
				'roles'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update'),
				'roles'=>array('UserCreator'),
				),
			array('allow', 
				'actions'=>array('admin','delete','watch'),
				'users'=>array('@'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
	/**
	 * Displays available feeds
	 * 
	 */
	public function actionFeeds($id="")
	{

	  if (!empty($id)) { 

	    if ((int)$id > 0) {
	      $query = "id={$id}";	    

	    } else {
	      $query = "identifier like '%" . $id . "%' or name like '%" . $id . "%'";

	    }
	  }

	  $channels = Channel::model()->findAll($query);

	  foreach ((array)$channels as $channel) {
	    $playlist = $channel->playlist;	    
	    $playlist_items = $playlist->Items;

	    foreach ((array)$playlist_items as $item) {
	      $items = array();

	      foreach (array("thumbnail_url", "length", "filename", "title") as $arr) {
		$items[$i][$arr] = $item->video->$arr;
		
		$i++;
	      }
	      
	    }

	    $data[] = array("id" => $channel->id, "name" => $channel->name, "items" => $items, "url" => "http://" . $channel->identifier . ".citystream.tv");
	    

	  }
	  
	  $this->render('//layouts/json',array("data" => $data));

	}

}