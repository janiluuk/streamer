<?php
$this->breadcrumbs=array(
	'Kanavat'=>array('admin'),
	Yii::t('AweCrud.app', 'Kaikki'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'Listaa kanavat') , 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Luo uusi kanava'), 'icon' => 'plus', 'url' => array('create')),
		  );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('channel-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Kaikki') ?> kanavat    </legend>

<?= CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Tarkka haku'), '#', array('class' => 'search-button btn')) ?>
<? if (Yii::app()->user->id == 1) 
echo CHtml::link('<i class="icon-plus"></i> ' . Yii::t('AweCrud.app', 'Lisää uusi'), '/channel/create', array('class' => 'add-button btn-success btn')) ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'channel-grid',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),

	'filter' => $model,
	'columns' => array(
        array(
			'value'=>'"<a href=\"/channel/update/" . $data->id . "\">" . $data->name . "</a>"',
			'type'=>'html',
		),

        'identifier',
        array(
                    'name' => 'status',
                    'value' => '$data->status == 1 ? "Päällä" : "Pois päältä"',
                    'filter' => CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn()),
                ),


        array(
                    'name' => 'user_id',
                    'value' => 'isset($data->user) ? $data->user->username : null',
                    'filter' => CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn()),
                ),
        'updated_at',

        /*
        'background_style',
        array(
                    'name' => 'background_image',
                    'value' => 'isset($data->backgroundImage) ? $data->backgroundImage : null',
                    'filter' => CHtml::listData(Image::model()->findAll(), 'id', Image::representingColumn()),
                ),
        'channel_style',
        'created_at',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			                'buttons'=>array(
        	      	'delete',
        		'view' => array( 'url'=> '"/channel/watch/" . $data->id'),
	 		'update' => array('visible' => function() { return false; }),
                	),
		),
	),
)); ?>
</fieldset>