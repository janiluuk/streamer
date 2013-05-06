<script type="text/javascript">
   function refreshPlaylist() {
   
   var playlist = $("#Channel_playlist_id").val();
   var channel_id = <?=$model->id;?>;

   $.post("/playlist/assign/"+playlist+"/"+channel_id, function (data) { $("#playlist").html(data); send(); } );
   


 }
   $(document).ready(function() { $("#Channel_playlist_id").change(function() { val = $(this).val(); if (val == "") $("#playlist").html("<h4>Ei soittolistaa</h4>");else refreshPlaylist(); })});  
</script>
<div class="form">
   <?php
Yii::app()->clientScript->registerCssFile("/css/wysiwyg.css");
Yii::app()->clientScript->registerScriptFile("/js/jquery.wysiwyg.js");
Yii::app()->clientScript->registerScript("wysiwyg", "$('.wysiwyg').wysiwyg();",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript("playlist", '
$(".createplaylist").click(function() { $("#playlist_form").load("/playlist/create", function() {                                                      
                                                                                                                                                       
$("#playlist-form").on("submit", function()  { var data=$("#playlist-form").serialize(); 
$.post("/playlist/create", data, function(data) { 

if (data.len > 10) $("#playlist_form").html(data); else {                                                                                                         
$("#playlist_form").fadeOut(); 
$("#Channel_playlist_id").append(new Option($("#Playlist_playlist_name").val(), data, true, true));
refreshPlaylist();
 }  });                                                                                                                          
 return false;                                                                                                                                   
                                                                                                                                     
                                                                                                                                                       
}) });  return false; });

', CClientScript::POS_READY);


    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'channel-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

 
<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'tabs'=>$this->getTabularFormTabs($form, $model, $video),
  )); ?>
 
<div class="form-actions clearfix">
  <?php $this->widget('bootstrap.widgets.TbButton', array(
'buttonType'=>'submit',
  'type'=>'primary',
  'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Luo') : Yii::t('AweCrud.app', 'Tallenna'),
  'htmlOptions' => array('class' => 'fr'),
  )); ?>
    <?php 
    /*
    $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Peruuta'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); 
		*/
		?>
 

   </div>
    <?php $this->endWidget(); ?>
</div>