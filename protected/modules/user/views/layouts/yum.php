<?php 
Yii::app()->clientScript->registerCssFile(
		Yii::app()->getAssetManager()->publish(
			Yii::getPathOfAlias('application.modules.user.assets.css').'/yum.css'));

$module = Yum::module();
$this->beginContent($module->baseLayout); ?>

<div class="span12">
<div id="usercontent" class="span6 fl" style="float:left;">
<?php
if (Yum::module()->debug) {
	echo CHtml::openTag('div', array(
				'style' => 'background-color: red;color:white;padding:5px;'));
	echo Yum::t('You are running the Yii User Management Module {version} in Debug Mode!', array(
				'{version}' => Yum::module()->version));
	echo CHtml::closeTag('div');
}
?>

<?php 
if($this->title)
	printf('<legend> %s </legend>', $this->title);  ?>
	<?php echo $content;  ?>
</div>
<div id="usermenu" class="span3" style="float:left;">

<?php Yum::renderFlash(); ?>
<?php $this->renderMenu(); ?>
</div>
</div>
<?php $this->endContent(); ?>
