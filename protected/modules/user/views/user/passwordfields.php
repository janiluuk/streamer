<div class="">
   <?php echo CHtml::label("Salasana",'password'); ?>
<?php echo CHtml::activePasswordField($form,'password'); ?>
</div>

<div class="">
<?php echo CHtml::label("Vahvista salasana",'verifyPassword'); ?>
<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
</div>

