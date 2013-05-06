<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>
<?php
$this->breadcrumbs=array(
			 "Kanavat" => array('admin'),
	Yii::t('app', $model->name) => array('view', 'id'=>$model->id),
	Yii::t('AweCrud.app', 'Muokkaa'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Channel::label(2), 'icon' => 'list', 'url' => array('index')),
	// array('label' => Yii::t('AweCrud.app', 'Create').' Channel', 'icon' => 'plus', 'url' => array('create')),
	//array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('view', 'id' => $model->id)),
	array('label' => Yii::t('AweCrud.app', 'Listaa'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => Yii::t('AweCrud.app', 'Poista'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
);


?>



<script type="text/javascript">
  $(document).ready(function() { 
      $('#channel_status').click(function() {


	  
    var btn = $(this);
    $(btn).html("Lataan..");
    $.get("/channel/toggle/<?=$model->id;?>", function(data) { 

	if (data == 2) {
	    $(btn).html("Suora l&auml;hetys");
	    $(btn).removeClass("btn-info").addClass("btn-danger");

	  }

	if (data == 1) {
	    $(btn).html("Pys&auml;yt&auml;");
	    $(btn).removeClass("btn-info").addClass("btn-danger");

	  }
	if (data == 0) {
	    $(btn).html("K&auml;ynnist&auml;");
	    $(btn).removeClass("btn-danger").addClass("btn-info");


	  }


   });

   
	});
    });

</script>

<script type="text/javascript">
   $(document).ready(function() { 
       $("#template_select").change(function() { 
	   var val = $(this).val();
	   $(".editor_template > div").attr("class", "custom_type"+val);       
	 } );
     });

</script>
<script type="text/javascript">
 
  function send(){
 
  var data=$("#channel-form").serialize();
 
 
  $.ajax({
    type: 'POST',
	url: '<?php echo Yii::app()->createAbsoluteUrl("channel/update/" . $model->id); ?>',
	data:data,
	success:function(data){
      },
	error: function(data) { // if error occured
	alert("Error occured.please try again");
	alert(data);
      },
 
	dataType:'html'
	});
 
}
 

</script>



<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Muokkaa') ?> kanavaa <?= CHtml::encode($model) ?>     </legend>
    <div style="float:right">
        <?
// On / Off button

if ($model->status == 1) { $label = "Pysäytä"; $type = "danger";}
elseif ($model->status == 2) { $label = "Suora läyetys"; $type = "danger";}
elseif ($model->status == 0) { $label = "Käynnistä"; $type = "info"; } else {$label = $model->status;}
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
									     'buttonType'=>'button',
									     'type'=>$type,
									     'label'=>$label,
									     'loadingText'=>'loading...',
									     'htmlOptions'=>array('id'=>'channel_status'),
));
?>
 <a class="btn btn-success" href="/channel/watch/<?=$model->id;?>">Kanavasivu</a>
</div>


  <?php echo $this->renderPartial('_form',array('model'=>$model, 'video' => $video)); ?></fieldset>


