<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>
<?php
$this->breadcrumbs=array(
	'Kanavat'=>array('admin'),
	$model->name,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Channel::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Katso kanavasivu'), 'icon' => 'pencil', 'url' => array('watch', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Luo uusi').' kanava', 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Päivitä'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Poista'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Hallinnoi'), 'icon' => 'list-alt', 'url' => array('admin')),
    
);
if ($model->status == 1) { $label = "Pysäytä"; $type = "danger";}
if ($model->status == 0) { $label = "Käynnistä"; $type = "info";}
?>
<div class="span-5"><?php $this->widget('bootstrap.widgets.TbButton', array(
									     'buttonType'=>'button',
									     'type'=>$type,
									     'label'=>$label,
									     'loadingText'=>'loading...',
									     'htmlOptions'=>array('id'=>'channel_status'),
									     )); ?>

<script type="text/javascript">
  $(document).ready(function() { 
      $('#channel_status').click(function() {


	  
    var btn = $(this);
    $(btn).html("Lataan..");
    $.get("/channel/toggle/<?=$model->id;?>", function(data) { 

	if (data == 1) {
	    $(btn).html("Pysäytä");
	    $(btn).removeClass("btn-info").addClass("btn-danger");

	  }
	if (data == 0) {
	    $(btn).html("Käynnistä");
	    $(btn).removeClass("btn-danger").addClass("btn-info");


	  }


   });

   
	});
    });

</script>


<fieldset>
    <legend><?= Yii::t('AweCrud.app', '') ?>  <?= CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'name',
        array(
			'name'=>'user_id',
			'value'=>($model->user !== null) ? CHtml::link($model->user, array('/user/yumUser/view', 'id' => $model->user->id)).' ' : null,
			'type'=>'html',
		),
	
	
        'identifier',
        'active',
        'background_color',
        'background_style',
        array(
			'name'=>'playlist.playlist_name',
			'value'=>($model->playlist->id !== null) ? CHtml::link($model->playlist->playlist_name, array('/playlist/view', 'id' => $model->playlist->id)).' ' : null,
			'type'=>'html',
		),

	

        'channel_style',

	),
)); ?>
</fieldset>
</div>
<div class="span-8">
<div id="fms" class="player" style=""></div>
<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>
<script type="text/javascript">
  $(function() {
      $f("fms", "/js/flowplayer/flowplayer-3.2.7.swf", {
	play:null, 
	    
 
      

	    clip: {  
	  autoPlay: true,
	      url: '<?=$model->getSdp();?>',
	      provider: 'rtmp',
	      // preserve aspect ratios
	      scaling: 'fit'
  
	      },

	    canvas: {
	    // customize player background, i.e. the canvas
	  backgroundColor: '#000000',
	      opacity: 0.3,
	      backgroundGradient: [0.0,0.0,0.0,0.0,0.0,0.0]
	      },
	    onLoad: function() {seeked = 0;},
	    onStart: function()
	    {
	      
	      
	    },
  
  
	    
	    plugins: {
	  controls: {
	    time:false,
		scrubber:false,
		borderRadius:24,
		top:'95pct',
		left:'50pct',
		width:'175',
		opacity: 1.0,
		backgroundColor: '#000000',

		volumeBarHeightRatio:0.3
		},
	      // RTMP streaming plugin
	      rtmp: {
	    url: '/js/flowplayer/flowplayer.rtmp-3.2.3.swf',
		netConnectionUrl: 'rtmp://citystream.tv/rtplive'
		},
        
	      // a content box so that we can see the selected bitrate. This is not normally
	      // used in real installations.
	      content: {
            url: '/js/flowplayer/flowplayer.content-3.2.0.swf',
		top: 0, left: 0, width: 400, height: 150,
		backgroundColor: 'transparent', backgroundGradient: 'none', border: 0,
		textDecoration: 'outline', 
		style: {  
	      body: {  
		fontSize: 14,
                    fontFamily: 'Arial', 
                    color: '#ffffff' 
		    }  
	      }  
	    }        
	  }

    
	})


	})
</script>

</div>