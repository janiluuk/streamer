<?
$type = Priceclass::getType($channel->priceclass->type); 
?>

<div id="summary">
  <h1>Kanavan hinta on <?=$channel->priceclass->amount;?> &euro;  / <? echo $type;



?>
</h1>
<button onclick="$('#buy').fadeOut('fast',function() { $('#code').fadeIn('slow'); }); " class="btn-primary btn-large">Anna katselukoodi</button>
  <button onclick="$('#code').fadeOut('fast',function() { $('#buy').fadeIn();});" class="btn-primary btn-large">Osta p&auml&auml;sylippu</button>
  <div class="clear">&nbsp;</div>
<div id="code" style="display:none">

																   <h4>Kirjoita koodi allaolevaan kentt&auml;&auml;n</h4>

    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'code-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> true,
    )); ?>
    <?= $form->errorSummary($model) ?>
<div id="coderesult" class="errorsummary error error-text"></div>
																   
								 <?= $form->textFieldRow($model, 'code', array('class' => 'span-3', 'style' =>'height:25px;', 'maxlength' => 128)) ?>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
   'htmlOptions' => array("onclick" => "var form=$('#code-form').serialize(); $.post('/order/authorizeCode/" . $channel->id . "', form, function(data) { $('#vid').html(data); }); return false;", "class" => "btn-small"),
   'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Jatka') : Yii::t('AweCrud.app', 'Jatka'))); ?>



</div>
    <?php $this->endWidget(); ?>
</div>
<div style="display:none" id="buy">

    
<script type="text/javascript">
  function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
      return true;
    }
    else {
      return false;
    }
}

</script>
<h4>Kirjoita e-mail osoitteesi alla olevaan kentt&auml;&auml;n ja paina jatka.</h4>

<div class="form alpha">

    <?php
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'order-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> true,
    )); ?>
    <?= $form->errorSummary($model) ?>

 <?= $form->textFieldRow($model, 'email', array('class' => 'span-3',"style" => 'height:25px',  'maxlength' => 128)) ?>

    <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
  'htmlOptions' => array("onclick" => "var form=$('#order-form').serialize(); var sEmail = $('#Order_email').val();
        if ($.trim(sEmail).length == 0) {
           alert('Anna postiosoitteesi ensin');
            e.preventDefault();
        }
        if (validateEmail(sEmail)) {
$.post('/order/purchase/" . $channel->id . "', form, function(data) { $('.form-actions').fadeOut('slow',function()  { $('#banks').html(data); })});
        }
        else {
            alert('Osoite on virheellinen');

            return false;
        }  return false;", "class" => "btn-small"),
   'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Jatka') : Yii::t('AweCrud.app', 'Jatka'))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Peruuta'),
   'htmlOptions' => array('onclick' => 'javascript:history.go(-1)', 'class' => 'btn-small')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
<div id="banks"></div>
<div class="clear clearfix"></div>

</div></div>

</div>