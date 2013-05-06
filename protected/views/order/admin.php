<?php
$this->breadcrumbs=array(
	'Tilaukset'=>array('admin'),
	Yii::t('AweCrud.app', 'Listaa'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Order::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' Order', 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Tilaukset') ?>   </legend>

<?= CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Tarkka haku'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'order-grid',
'template' => '{summary}{pager}{items}{pager}',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
        array('name' => 'valid_from', 'value' => 'date("d.m.y H:i", strtotime($data->created_at))'),
array('name' => 'valid_to', 'value' => 'date("d.m.y H:i", strtotime($data->valid_to))'),
        'email',
        'amount',
        'code',

        array(
                    'name' => 'channel_id',
                    'value' => 'isset($data->channel) ? $data->channel : null',
                    'filter' => CHtml::listData(Channel::model()->findAll(), 'id', Channel::representingColumn()),
                ),
        /*
        'payment_type',

        'created_at',
        array(
                    'name' => 'price_class_id',
                    'value' => 'isset($data->priceClass) ? $data->priceClass : null',
                    'filter' => CHtml::listData(Priceclass::model()->findAll(), 'id', Priceclass::representingColumn()),
                ),
        'transaction_data',
        'status',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			                'buttons'=>array(
        	      	'delete',
        		'view' => array( 'url'=> '"/order/view/" . $data->id', 'options'=> array("data-update-dialog-title" => "Tilauksen tiedot", "class" =>"update-dialog-open-link")),
	 		'update' => array('visible' => function() { return false; }),
                	),

		),
	),
)); ?>
</fieldset>