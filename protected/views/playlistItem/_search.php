<?php
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?= $form->textFieldRow($model, 'id', array('class' => 'span5')); ?>

<?= $form->dropDownListRow($model, 'playlist_id', CHtml::listData(Playlist::model()->findAll(), 'id', Playlist::representingColumn())); ?>

<?= $form->dropDownListRow($model, 'video_id', CHtml::listData(Video::model()->findAll(), 'id', Video::representingColumn())); ?>

<?= $form->textFieldRow($model, 'order', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
