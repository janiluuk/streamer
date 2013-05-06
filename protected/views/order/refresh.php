<div class="well">
   <p>Koodi voimassa, katseluaikaa <b><?=date("d.m.Y H:i", strtotime($order->valid_to));?></b> saakka.</p>
   <p>Sirryt&auml;&auml;n kanavalle ..</p>
<script type="text/javascript">
<?
      $value = isset(Yii::app()->request->cookies[$channel->identifier]) ? Yii::app()->request->cookies[$channel->identifier]->value : '';
			      if (!empty($value)) echo ' setTimeout("location.reload(true)",200);';
?>
</script>
<a href="<?=$channel->getUrl();?>?code=<?=$order->code?>"><button class="btn btn-large btn-primary">Jatka</button></a>
</div>