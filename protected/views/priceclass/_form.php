<div class="form">
    <?php
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'priceclass-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>



    <?= $form->errorSummary($model) ?>

<div class="fl span-5">                            <?= $form->textFieldRow($model, 'name', array('class' => 'span-5', 'maxlength' => 64)) ?></div>
<div class="fl span-2">                        <?= $form->textFieldRow($model, 'amount', array('class' => 'fl span-2')) ?></div>

<div class="fl span-3"> <?= $form->dropDownListRow($model, 'type', CHtml::listData(Priceclass::getTypes(),"id","name"), array('class' => 'fl span-3')) ?></div>



                <div class="clear form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Luo uusi') : Yii::t('AweCrud.app', 'Tallenna'),
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>