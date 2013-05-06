<?php
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?= $form->textFieldRow($model, 'id', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 64)); ?>

<?= $form->textFieldRow($model, 'amount', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'type', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
