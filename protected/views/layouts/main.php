<?php 
/* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" media="screen, projection" />
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
<?	Yii::app()->clientScript->registerScriptFile('/js/site/jquery.ui.min.js', CClientScript::POS_HEAD); 
	  Yii::app()->clientScript->registerScriptFile("/js/site/elfinder.min.js", CClientScript::POS_END);?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>




	<div id="main-menu">
   <?php

   $user = Yii::app()->user->data()->id;
if ($user) {
  if (Yii::app()->user->id == 1)   $channels = Channel::model()->findAll();
  else $channels = Channel::model()->findAll("user_id={$user}");
foreach ((array)$channels as $channel) {
  $channel_array[] = array("url" => "/channel/update/" . $channel->id, "label" => $channel->name);
}

}


?>
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
							    'type'=>'inverse', // null or 'inverse'

							    'brand'=>'Citystream',
							    'brandUrl'=>'/',
							    'collapse'=>true, // requires bootstrap-responsive.css
							    'items'=>array(
									   array(
										 'class'=>'bootstrap.widgets.TbMenu',
										 'items'=>array(
												array('label'=>'Soittolistat', 'url'=>array('/playlist/admin'), 'visible'=>!Yii::app()->user->isGuest),
												array('label'=>'Videot', 'url'=>array('/video/admin'), 'visible'=>!Yii::app()->user->isGuest),

												array('label'=>'Kirjasto', 'url'=>array('/site/file_manager', 'view' => 'shop'),  'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class' =>'update-dialog-open-link', 'data-update-dialog-title' => 'Kirjasto', 'data-update-dialog-width' => 860)),

												),
										 ),

									   array(
										 'class'=>'bootstrap.widgets.TbMenu',
										 'htmlOptions'=>array('class'=>'pull-right'),
										 'items'=>array(

												'---',
												array('label'=>'Kanavat','visible'=>!Yii::app()->user->isGuest, 'url'=>'#', 'items'=>array_merge((array)$channel_array, array(
																							   '---',
																		      array('label'=>'Kanavien hallinnointi'),

																							   array('label'=>'Kaikki kanavat', 'url'=>array('/channel/admin')),																		      array('label'=>'Soittolistat', 'url'=>array('/playlist/admin')),

																										       ))),
												array('label'=>'Asetukset', 'visible'=>!Yii::app()->user->isGuest, 'url'=>'#', 'items'=>array(
																							       array('label'=>'Omat tiedot', 'url'=>array("/user/user/view/id/" . Yii::app()->user->data()->id)),
																							       array('label'=>'Hintaluokat', 'url'=>array('/priceclass/admin'), 'visible' => Yii::app()->user->id == 1),

																							       array('label'=>'Tilaukset', 'url'=>array('/order/admin'), 'visible' => Yii::app()->user->id == 1),
																							       array('label'=>'Käyttäjät','visible' => !Yii::app()->user->isGuest, 'url'=>array('user/user/admin')),																		      '---',
																							       array('label'=>'Vaihda salasana', 'url'=>array('/user/user/changePassword',)),
																		      )),
												array('label'=>'Kirjaudu', 'url'=>array('/user/auth'), 'visible'=>Yii::app()->user->isGuest),
												array('label'=>'Kirjaudu ulos ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
												),
										 ),
									   ),
							    )); ?>
<br/>

</div>
<div class="container" id="page">
	<!-- mainmenu --><br/>
	<?php if(isset($this->breadcrumbs)):?>
								 <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
								 'links'=>$this->breadcrumbs,
															      )); ?>

			<?php endif;?>


	<?php echo $content; ?>
<? $this->widget('ext.EUpdateDialog.EUpdateDialog', array("dialogOptions" => array("width" => 640, "height"=> 500, "title" => $title))); ?>
	<div class="clear"></div>

	<div id="footer">
    Copyright &copy; <?php echo date('Y'); ?>  janiluuk@gmail.com<br/>

	</div><!-- footer -->

</div><!-- page -->



</body>
</html>
