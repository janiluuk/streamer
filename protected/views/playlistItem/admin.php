<?php
$this->breadcrumbs=array(
	'Playlist Items'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . PlaylistItem::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' PlaylistItem', 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('playlist-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Manage') ?> <?= PlaylistItem::label(2) ?>    </legend>

<?= CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'playlist-item-grid',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
        'id',
        array(
                    'name' => 'playlist_id',
                    'value' => 'isset($data->playlist) ? $data->playlist : null',
                    'filter' => CHtml::listData(Playlist::model()->findAll(), 'id', Playlist::representingColumn()),
                ),
        array(
                    'name' => 'video_id',
                    'value' => 'isset($data->video) ? $data->video : null',
                    'filter' => CHtml::listData(Video::model()->findAll(), 'id', Video::representingColumn()),
                ),
        'order',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>