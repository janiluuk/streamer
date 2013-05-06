<?php
$this->breadcrumbs=array(
	'Playlist Items'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.PlaylistItem::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create').' PlaylistItem', 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'View') ?> PlaylistItem <?= CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'id',
        array(
			'name'=>'playlist_id',
			'value'=>($model->playlist !== null) ? CHtml::link($model->playlist, array('/playlist/view', 'id' => $model->playlist->id)).' ' : null,
			'type'=>'html',
		),
        array(
			'name'=>'video_id',
			'value'=>($model->video !== null) ? CHtml::link($model->video, array('/video/view', 'id' => $model->video->id)).' ' : null,
			'type'=>'html',
		),
        'order',
	),
)); ?>
</fieldset>