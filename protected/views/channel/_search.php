<?php
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?= $form->textFieldRow($model, 'id', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 128)); ?>

<?= $form->dropDownListRow($model, 'user_id', CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn())); ?>

<?= $form->textFieldRow($model, 'identifier', array('class' => 'span5', 'maxlength' => 64)); ?>

<?= $form->textFieldRow($model, 'active', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'background_color', array('class' => 'span5', 'maxlength' => 6)); ?>

<?= $form->textFieldRow($model, 'background_style', array('class' => 'span5')); ?>

<?= $form->dropDownListRow($model, 'background_image', CHtml::listData(Image::model()->findAll(), 'id', Image::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))); ?>

<?= $form->textFieldRow($model, 'channel_style', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'updated_at', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'created_at', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
