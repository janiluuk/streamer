<div class="clear">&nbsp;</div>
<div class="well">
<?
$type = Priceclass::getType($channel->priceclass->type); 
?>
<form method="post" action="http://<?=$model->channel->identifier;?>.citystream.tv">
<div id="summary">
   <h1> Maksu onnistui! </h1>

   <p>Katselukoodisi on <b><?=$model->code;?></b> ja se on voimassa <b><?=date("d.m.Y H:i", strtotime($model->valid_to));?></b> asti</p>
   <br/>Koodi on lähetetty myös sähköpostiisi josta voit hakea sen uudelleen.

   <p>Paina <b>Jatka</b> siirtyäksesi kanavan sivulle</p>
   <div class="form-actions">
<input type="hidden" name="code" value="<?=$model->code;?>"/>
   
   
           <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Siirry kanavalle'),
			'htmlOptions' => array("class" => "btn-large")
		)); ?>
</a>
   </div>
</form>
</div>
</div>