<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-22">
	<div id="content">

<?php $this->widget('bootstrap.widgets.TbAlert', array(
'block'=>true, // display a larger alert block?
  'fade'=>true, // use transitions?
  'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
  'alerts'=>array( // configurations per alert type
		  'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		   ),
  )); ?>

		<?php echo $content; ?>
	</div><!-- content -->
</div>

</div>
<?php $this->endContent(); ?>