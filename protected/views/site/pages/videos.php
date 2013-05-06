<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . '';
$this->breadcrumbs=array(
	'Frontpage',
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Add video',
							'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							)); ?>

<div class="productcontainer" style="text-align:center;margin-left:auto;margin-right:auto;padding:50px;">

<?php 
$listDataProvider = new CArrayDataProvider(array(
						 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),
					 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),					 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),
						 array('id'=>2, 'pin' => '1212121212', 'datum' => '08.11.2012', 'amount' => '€ 18.00', 'number' => '3725526000'),
						 array('id'=>3, 'pin' => '1212121212', 'datum' => '09.11.2012', 'amount' => '€ 4.00', 'number' => '3725526000'),
						 ));

$this->widget('bootstrap.widgets.TbThumbnails', array(
							    'dataProvider'=>$listDataProvider,
							    'template'=>"{items}\n{pager}",
							    'itemView'=>'_thumb',
							    )); ?>
</div>


<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Add playlist',
							'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							)); ?>

<div class="productcontainer" style="text-align:center;margin-left:auto;margin-right:auto;padding:50px;">

<?php 
$listDataProvider = new CArrayDataProvider(array(
						 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),
					 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),					 array('id'=>1, 'pin' => '1212121212', 'datum' => '07.11.2012', 'amount' => '€ 10.00', 'number' => '3725526000'),
						 array('id'=>2, 'pin' => '1212121212', 'datum' => '08.11.2012', 'amount' => '€ 18.00', 'number' => '3725526000'),
						 array('id'=>3, 'pin' => '1212121212', 'datum' => '09.11.2012', 'amount' => '€ 4.00', 'number' => '3725526000'),
						 ));

$this->widget('bootstrap.widgets.TbThumbnails', array(
							    'dataProvider'=>$listDataProvider,
							    'template'=>"{items}\n{pager}",
							    'itemView'=>'_thumb',
							    )); ?>
</div>