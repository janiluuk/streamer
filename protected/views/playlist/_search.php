<?php
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?= $form->textFieldRow($model, 'id', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'playlist_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?= $form->checkBoxRow($model, 'active'); ?>

<?= $form->textFieldRow($model, 'from', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'to', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'channel_id', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
