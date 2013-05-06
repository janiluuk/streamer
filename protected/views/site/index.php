<div class="span-24">
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . '';
$this->breadcrumbs=array(
	'Etusivu',
);
?>
<div id="frontpage" style="max-width:900px;">
		<a href="/site/file_manager">
		<div id="container">
		<div id="kirjasto" class="link">
			<img src="/images/Library.png"/>
			<div class="linkname">Kirjasto</div>
			<div class="linkdiscription">Hallinnoi ja lataa tiedostoja</div>
		</div>
		</a>

		<a href="/playlist/admin">
		<div id="soittolistat" class="link" href="#">
			<img src="/images/Playlist.png"/>
			<div class="linkname">Soittolistat</div>
			<div class="linkdiscription">Luo ja hallinnoi soittolistoja</div>
		</div>
		</a>

		<a href="/channel/admin">
		<div id="kanavat" class="link" href="#">
			<img src="/images/Channel.png"/>
			<div class="linkname">Kanavat</div>
			<div class="linkdiscription">Luo ja hallinnoi kanaviasi</div>
		</div>
		</a>

		<a href="/Priceclass/admin">
		<div id="hintaryhmat" class="link" href="">
			<img src="/images/Pricegroup.png"/>
			<div class="linkname">Hintaryhmät</div>
			<div class="linkdiscription">Maksullisen sisällön hallinnointi</div>
		</div>
		</a>
		</div>

<!--
<div style="float:left;min-width:150px;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Kirjasto',
							'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							'url' => '/site/file_manager'
							)); ?>
</div><div style="float:left;min-width:150px;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Soittolistat',
							'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							'url' => '/playlist/admin'
							)); ?></a>
</div><div style="float:left;min-width:150px;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Kanavat',
							'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							'url' => '/channel/admin'
							)); ?>
</div><div style="float:left;min-width:150px;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'Hintaryhmät',
							'type'=>'warning', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'large', // null, 'large', 'small' or 'mini'
							'url' => '/priceclass/admin'
							)); ?>
</div>  -->
</div>
</div>
