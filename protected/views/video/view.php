<?php
$this->breadcrumbs=array(
	'Videokirjasto'=>array('index'),
	$model->title,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Video::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create').' Video', 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
<legend><?= Yii::t('AweCrud.app', '').  $model->title; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'id',
        'title',
        'filesize',
        'filename',
        'filepath',
        'created_at',
        'updated_at',
        'language_id',
        'type',
        'bitrate',
        'framerate',
        'video_container',
        'video_codec',
        'audio_codec',
        'audio_samplerate',
        'video_width',
        'video_height',
        'length',
        'profile',
        'is_primary',
        'primary',
        array(
                'name'=>'deleted',
                'type'=>'boolean'
            ),
        array(
			'name'=>'user_id',
			'value'=>($model->user !== null) ? CHtml::link($model->user, array('/user/yumUser/view', 'id' => $model->user->id)).' ' : null,
			'type'=>'html',
		),
	),
)); ?>
</fieldset>