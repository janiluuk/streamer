    <p class="note">
    <?= $form->errorSummary($model) ?></p>
<div class="fl span-5">
      <?= $form->textFieldRow($model, 'name', array('class' => 'span-4 fl', 'maxlength' => 64,'style' => 'width:150px;')) ?>
</div>

       <?

       if (Yii::app()->user->id == 1) {
	 echo '<div class="fl span-5">';
	 echo $form->dropDownListRow($model, 'user_id', CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn()), array('class' => 'fl span-5'));
	 echo '</div>';

       } else {
	  echo $form->hiddenField($model, 'user_id', array('value' => Yii::app()->user->id));
       }
?>
<div class="fl span-7">
       <?= $form->textFieldRow($model, 'identifier', array('class' => 'span5 fl', 'maxlength' => 64, 'style' => 'width:150px')) ?><small><b>.citystream.tv</b></small>
</div>
<div class="clear span-5">
       <?= $form->dropDownListRow($model, 'price_class_id', CHtml::listData(Priceclass::model()->findAll(), 'id', 'name'), array('class' => 'fl span-5')) ?>
   </div>
<?	 echo '<div class="fl span-5">';
echo $form->dropDownListRow($model, 'status', Channel::getStatusList(), array('class' => 'fl span-5'));
	 echo '</div>';
?>
<?
   if ($model->id) {
     $this->renderPartial("_extra", array("model" => $model),false,false);

   }
?>




