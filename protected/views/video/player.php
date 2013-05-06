<?
$url =   $model->getRtmpLink();
Yii::app()->clientScript->registerScript("aaa", "var player = null;", CClientScript::POS_HEAD);



foreach((array)$movie[0]->contentvideos as $vid) {
  $bitrates[] = array("label" => $vid->getProfileName(), "url" =>  "" . $vid->getRtmpLink(),  "width" => (int)$vid->video_width, "bitrate" => (int)$vid->bitrate,  $vid->getRtmpLink() == $url ? true:false);

}
?>

<?

    $this->widget('ext.EFlowPlayer.EFlowPlayer', array(
         'flv'=>array(
		      "url" => str_replace("/Videot/", "/Videot/800/",str_replace(".mp4", "-800.mp4", $url)),
         ),
         'htmlOptions'=>array(
             'id'=>'testingplayer',
             'style'=>'width: 605px; height: 427px;',
         ),
	 //	 'bitrates' => $bitrates,
     ));
?>
