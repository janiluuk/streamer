<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle="Videokirjasto";
$this->breadcrumbs=array(
	'Videokirjasto',
);
?>

<script type="text/javascript"> 
	$(document).ready(function(){
        
        var f = $('#finder').elfinder({
            url : '<?=Yii::app()->request->baseUrl . "/site/files";?>',
            lang : 'en',
	      closeOnEditorCallback : false,
            docked : true,
             dialog : {
             	title : 'File manager',
             	height : 500
             }
        }).find('.el-finder-toolbar').addClass('ui-corner-top');
	 });
</script> 
                                <div id="finder"></div>


