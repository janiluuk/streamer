<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class=errormessage>Error <?php echo $code; ?></div>
<div class="errorpicture"><img src="/images/error.png"></div>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>