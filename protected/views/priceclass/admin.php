<?php
$this->breadcrumbs=array(
	'Hintaluokat'=>array('index'),
	Yii::t('AweCrud.app', 'Kaikki'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Priceclass::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' Priceclass', 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('priceclass-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Hintaluokat') ?>   </legend>

<?= CHtml::link('<i class="icon-plus"></i> ' . Yii::t('AweCrud.app', 'Lisää uusi'), '/priceclass/create', array('class' => 'add-button btn-success btn')) ?>
<?= CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Tarkka haku'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'priceclass-grid',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
        'name',
        array(
					'name' => 'amount',
					'value' => '$data->amount . " €"',
	      ),

        array(
					'name' => 'type',
					'value' => 'Priceclass::getType($data->type)',
					'filter' => array('0' => Yii::t('AweCrud.app', 'Ilmainen'), '1' => Yii::t('AweCrud.app', 'Maksullinen')),
					),

	
	array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array(	      	'delete','update',	 		'view' => array('visible' => function() { return false; }),)


		      ),
			   )));
?>
</fieldset>