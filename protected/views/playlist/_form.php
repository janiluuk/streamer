<div class="form">
    <?php
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'playlist-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>



    <?= $form->errorSummary($model) ?>
			<div class="span-4 fl" style="max-width:150px;">
                            <?= $form->textFieldRow($model, 'playlist_name', array('class' => 'span5 fl', 'maxlength' => 255, 'style' => 'width:100px')) ?>
                
    </div><div class="fl span-5" style="max-width:150px;">
                        <?= $form->textFieldRow($model, 'from', array('class' => 'span-4 fl')) ?>
                        </div><div class="span-4 fl" style="width:150px;">
                        <?= $form->textFieldRow($model, 'to', array('class' => 'span-4 fl')) ?></div>
   <?php echo $form->hiddenField($model,'user_id', array("id" => "background_image", "value" => Yii::app()->user->data()->id)); ?>

                        <br/>
  <div class="clear clearfix"></div>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Luo') : Yii::t('AweCrud.app', 'Tallenna'),
			'htmlOptions' => array('class' => 'fr'),
		)); ?>
        <?php /* $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Peruuta'),
			'htmlOptions' => array('class' => 'fr btn', 'onclick' => 'javascript:history.go(-1)')
		));
		*/ ?>
 

    <?php $this->endWidget(); ?>
</div>