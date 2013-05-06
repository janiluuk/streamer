<div class="form">
    <?php
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'order-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?= Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?= Yii::t('AweCrud.app', 'are required') ?>.    </p>

                        <?= $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 64)) ?>
                        <?= $form->textFieldRow($model, 'valid_from', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'valid_to', array('class' => 'span5')) ?>
                        <?= $form->dropDownListRow($model, 'channel_id', CHtml::listData(Channel::model()->findAll(), 'id', Channel::representingColumn())) ?>
                        <?= $form->textFieldRow($model, 'payment_type', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'amount', array('class' => 'span5', 'maxlength' => 2)) ?>
                                <?= $form->dropDownListRow($model, 'price_class_id', CHtml::listData(Priceclass::model()->findAll(), 'id', Priceclass::representingColumn())) ?>
                        <?= $form->textAreaRow($model,'transaction_data',array('rows'=>6, 'cols'=>50, 'class'=>'span8')) ?>
                        <?= $form->textFieldRow($model, 'status', array('class' => 'span5')) ?>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>