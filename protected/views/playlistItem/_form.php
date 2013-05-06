<div class="form">
    <?php
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'playlist-item-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?= Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?= Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?= $form->errorSummary($model) ?>

                            <?= $form->dropDownListRow($model, 'playlist_id', CHtml::listData(Playlist::model()->findAll(), 'id', Playlist::representingColumn())) ?>
                        <?= $form->dropDownListRow($model, 'video_id', CHtml::listData(Video::model()->findAll(), 'id', Video::representingColumn())) ?>
                        <?= $form->textFieldRow($model, 'order', array('class' => 'span5')) ?>
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