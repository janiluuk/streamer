<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Order::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create').' Order', 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
<legend><?= Yii::t('AweCrud.app', '') ?> Tilaus #<?=$model->id;?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        array(
                'name'=>'email',
                'type'=>'email'
            ),
        'code',
        'valid_from',
        'valid_to',
        array(
			'name'=>'channel_id',
			'value'=>($model->channel !== null) ? CHtml::link($model->channel, array('/channel/view', 'id' => $model->channel->id)).' ' : null,
			'type'=>'html',
		),
        'payment_type',
        'amount',
        'created_at',
        array(
			'name'=>'price_class_id',
			'value'=>($model->priceclass !== null) ? CHtml::link($model->priceclass, array('/priceclass/view', 'id' => $model->priceclass->id)).' ' : null,
			'type'=>'html',
		),
        'status',
	),
)); ?>
</fieldset>