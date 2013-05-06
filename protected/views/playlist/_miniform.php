<div class="form">
    <?php
    /** @var AweActiveForm $form */
   Yii::app()->clientScript->registerScript('playlist_miniform', '
 $("#playlist-form").on("submit", function() {  alert("Moi"); return false;} );', CClientScript::POS_READY);
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'playlist-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

<?= $form->errorSummary($model) ?>
			<div class="span-8 fl" style="max-width:300px;">
                            <?= $form->textFieldRow($model, 'playlist_name', array('class' => 'span5 fl', 'maxlength' => 255, 'style' => 'width:100px')) ?> 
                

                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Luo') : Yii::t('AweCrud.app', 'Tallenna'),
			'htmlOptions' => array('class' => 'fl'),
		)); ?>
    </div>
 

    <?php $this->endWidget(); ?>
</div>
