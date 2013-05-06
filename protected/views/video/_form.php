<div class="form">
    <?php
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'video-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?= Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?= Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?= $form->errorSummary($model) ?>

                            <?= $form->textAreaRow($model,'title',array('rows'=>6, 'cols'=>50, 'class'=>'span8')) ?>
                        <?= $form->textFieldRow($model, 'filesize', array('class' => 'span5', 'maxlength' => 20)) ?>
                        <?= $form->textAreaRow($model,'filename',array('rows'=>6, 'cols'=>50, 'class'=>'span8')) ?>
                        <?= $form->textAreaRow($model,'filepath',array('rows'=>6, 'cols'=>50, 'class'=>'span8')) ?>
                                        <?= $form->textFieldRow($model, 'language_id', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'type', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'bitrate', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'framerate', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'video_container', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?= $form->textFieldRow($model, 'video_codec', array('class' => 'span5', 'maxlength' => 45)) ?>
                        <?= $form->textFieldRow($model, 'audio_codec', array('class' => 'span5', 'maxlength' => 45)) ?>
                        <?= $form->textFieldRow($model, 'audio_samplerate', array('class' => 'span5', 'maxlength' => 45)) ?>
                        <?= $form->textFieldRow($model, 'video_width', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'video_height', array('class' => 'span5')) ?>
                        <?= $form->textFieldRow($model, 'length', array('class' => 'span5', 'maxlength' => 16)) ?>
                        <?= $form->textFieldRow($model, 'profile', array('class' => 'span5', 'maxlength' => 1)) ?>
                        <?= $form->textFieldRow($model, 'is_primary', array('class' => 'span5', 'maxlength' => 1)) ?>
                        <?= $form->textFieldRow($model, 'primary', array('class' => 'span5', 'maxlength' => 1)) ?>
                        <?= $form->checkBoxRow($model, 'deleted') ?>
                        <?= $form->dropDownListRow($model, 'user_id', CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn())) ?>
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