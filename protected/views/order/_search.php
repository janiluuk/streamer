<?php
/** @var AweActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

<?= $form->textFieldRow($model, 'id', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?= $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 64)); ?>

<?= $form->textFieldRow($model, 'valid_from', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'valid_to', array('class' => 'span5')); ?>

<?= $form->dropDownListRow($model, 'channel_id', CHtml::listData(Channel::model()->findAll(), 'id', Channel::representingColumn())); ?>

<?= $form->textFieldRow($model, 'payment_type', array('class' => 'span5')); ?>

<?= $form->textFieldRow($model, 'amount', array('class' => 'span5', 'maxlength' => 2)); ?>

<?= $form->textFieldRow($model, 'created_at', array('class' => 'span5')); ?>

<?= $form->dropDownListRow($model, 'price_class_id', CHtml::listData(Priceclass::model()->findAll(), 'id', Priceclass::representingColumn())); ?>

<?= $form->textAreaRow($model,'transaction_data',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?= $form->textFieldRow($model, 'status', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => Yii::t('AweCrud.app', 'Search'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
