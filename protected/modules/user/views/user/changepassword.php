<?php 
$this->pageTitle = Yii::app()->name . ' - ' . Yum::t("Salasanan vaihto");
echo '<h2>'. Yum::t('Vaihda salasana') .'</h2>';

$this->breadcrumbs = array(
	Yum::t("Vaihda salasana"));

if(isset($expired) && $expired)
	$this->renderPartial('password_expired');
?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>

	<?php if(!Yii::app()->user->isGuest) {
		echo '<div class="">';
echo CHtml::label("Nykyinen salasana","currentPassword");
		echo CHtml::activePasswordField($form,'currentPassword'); 
		echo '</div>';
	} ?>

<?php $this->renderPartial(
		'application.modules.user.views.user.passwordfields', array(
			'form'=>$form)); ?>

	<div class="submit">
  <?php echo CHtml::submitButton(Yum::t("Vaihda"), array('class' => 'btn span-5 btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
