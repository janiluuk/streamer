
<html>
<head>

<title><?=$title;?></title>

    <script src="http://releases.flowplayer.org/js/flowplayer-3.2.11.min.js"></script>
<script src="/js/flowplayer.playlist-3.2.10.min.js"></script>
<script src="/js/easypaginate.js"></script>
<link rel="stylesheet" type="text/css" href="/css/style.css" />

<style type="text/css">
   li{margin:0 0 0 2em;padding:0;display:list-item;list-style-position:outside;}
ul#items{
margin:0;
height:130px;
width:auto;
overflow:hidden;
}
.cliptable li {
  font-family: arial;
  font-size: 9pt;
}
ul#items li {
  list-style: none;
  text-align: center;
}

ul#items li{
  list-style:none;
  float:left;
width:150px;
height:130px;
overflow:hidden;
margin:10 0 0 1px;
  
color:#<?=$model->color;?>;
  text-align:center;
}
ol#pagination{overflow:hidden;background-color:<?=$model->area_color;?>;margin:10px;border-radius:3px;padding:2px;font-family:arial;text-align:center;}
ol#pagination li{
  float:left;
  list-style:none;
cursor:pointer;
margin:0 0 0 .5em;
}
ol#pagination li.current{color:#f00;font-weight:bold;background-color:white;border-radius:4px;padding:0 5 0 5px;}

/* // content */
</style>




<style type="text/css">
<?
   Yii::app()->clientScript->scriptMap = array(
					       'style.css'         => false,
					       );

   if (empty($bgcolor)) $bgcolor = "000000";
   if (empty($color)) $color = "FFFFFF";

?>

.image_carousel img { 
  border: 1px solid #<?=$model->border_color;?>;
  background-color: #<?=$model->area_color;?>;
}
.pagewrapper {

display: inline-block;
  max-width: 815px;
  min-width: 400px;
  text-align: center;

 }
body, body.channel {
width:100%;
height:100%;
  
<?  
  if (!empty($model->background_image)) {
    echo "background-image: url('" . iconv("UTF-8","ISO-8859-15",$model->background_image) . "');";
  } else {
    
    echo "background-color:#" . $model->background_color ."; color:#".$model->color.";"; 
    echo "background:#" . $model->background_color . ";";
  }

  if ($model->background_style != "") { 
    
    
    if ($model->background_style=="0")echo "background-size: auto !important;"; 
    if ($model->background_style=="1")echo "background-size:100% auto;"; 
    if ($model->background_style=="2")echo "background-size:auto 100%;";
    if ($model->background_style=="3")echo "";
  }

?>

background-repeat:<? if ($model->background_repeat == "") echo "no-repeat"; else { 
  if ($model->background_repeat == 0) echo "no-repeat";
  if ($model->background_repeat == 1) echo "repeat";
  if ($model->background_repeat == 2) echo "repeat-x";
  if ($model->background_repeat == 3) echo "repeat-y";
}
?>; 


background-position: <? if ($model->background_position == "") echo "center 0px"; else echo $model->background_position; ?>;
margin: 0px 0px 0px 0px; padding:0px;

<?
if (!empty($model->header_color)) {
  echo "h1, h2, h3, h4: #" . $model->header_color. ";";
}
?>

}

.area { 
background-color: #<?=$model->area_color; ?>; 
width:815px;
border:2px solid #<?=$model->border_color; ?>;
border-radius:5px 5px 5px 5px;
margin:5px;

 }

div#videoarea {
		padding:8px 0px 0px 0px;
border:2px solid #<?=$model->border_color;?>;
		width:815px;
		height:464px;
  /*		-moz-box-shadow:3px 3px 12px black;-webkit-box-shadow:3px 3px 12px black;-ms-box-shadow:3px 3px 12px black;-o-box-shadow:3px 3px 12px black;	
		box-shadow:3px 3px 12px black; */
		overflow:auto;
}

</style>


</head>
<body class="channel style<?=$model->channel_style;?>" marginwidth="0" marginheight="0">

<div align="center" class="pagewrapper">




<?



	  foreach ((array)array(1,2,3,4,5,6) as $reg) {
	  echo '<div id="region' . $reg . '">';
	  $style = "region{$reg}_style";
	  $content = "region{$reg}_content";

	  if(!empty($model->$style)) {

    if ($model->$style == "4") {
	      
      echo "<div class=\"area\" style=\"min-height:120px\">";
      $this->renderPartial("/channel/_playlist_items", array("model" => $model),false,true);
      echo "</div>";
    }

	    if ($model->$style == "2") {
	      
	      echo "<div class=\"area\">" . $model->$content . "</div>";
	    }
	    if ($model->$style == "3") {

	      echo "<div class=\"area\">". CHtml::image($model->$content,"", array("style" => "max-height:120px")) . "</div>";
	    }
	    if ($model->$style == "1") {
	      echo '<div id="videoarea" class="area"><div id="fms" class="player"></div></div>';


	    }
	    
	  }
	  echo "</div>";
	}
?>






</div>

<?

$playlist = $model->playlist->getPlaylistPosition();
$time = $playlist["time"];


?>
<?
if ($model->status == 2) {

?>
<script type="text/javascript">
  $(function() {
      $f("fms", "http://releases.flowplayer.org/swf/flowplayer-3.2.15.swf", {

	    clip: {  
	  buffer: false,
	      url: '<?=$model->identifier;?>.sdp',
	      provider: 'rtmp',
	      live: true,
	      // preserve aspect ratios
	      scaling: 'fit',
	      autoPlay: true
	      },

	    canvas: {
	    // customize player background, i.e. the canvas
	  backgroundColor: '#000000',
	      opacity: 0.3,
	      backgroundGradient: [0.0,0.0,0.0,0.0,0.0,0.0]
	      
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
	    url: 'flowplayer.rtmp-3.2.11.swf',
		netConnectionUrl: 'rtmp://citystream.tv/rtplive'
		}
        
	      // a content box so that we can see the selected bitrate. This is not normally
	      // used in real installations.
	  }

    
	})


	});
</script>
<?
    } else {
?>
	
<script type="text/javascript"> 
$(function() {
    $f("fms", "http://releases.flowplayer.org/swf/flowplayer-3.2.15.swf",{
	play:null, 
            playlist: [ <?=$playlist["items"]; ?> ], 

      clip: {  
    autoPlay: true,
	scaling: 'scale',
	  	provider:'rtmp',
	baseUrl: "http://citystream.tv",
	// preserve aspect ratios

	onFinish: function() { 
	this.getScreen().fadeOut(4000);
      },
	onStart: function() { this.getScreen().fadeIn(5000); }

  
    },

      canvas: {
      // customize player background, i.e. the canvas
        backgroundColor: '#<?=$model->background_color?>',
	opacity: 0.3,
	backgroundGradient: [0.0,0.0,0.0,0.0,0.0,0.0]
	    },
      
      onLoad: function() {seeked = 0;},
      onStart: function()
      {
	
	
	if (seeked == 0)
	  {
	    $f().seek(<?=$time;?>);
	    seeked = 1;
	  }
	
      },
 		 
      
    plugins: {
		controls: {
			time:false,
			scrubber:false,
			borderRadius:24,
			top:'95pct',
			left:'50pct',
			width:'175',
			opacity: 0.9,


			volumeBarHeightRatio:0.3
		},
        // RTMP streaming plugin
        rtmp: {
	  url: 'flowplayer.rtmp-3.2.11.swf',
	  netConnectionUrl: 'rtmp://citystream.tv/vod'
	  }
        
                
    }

    
      });


})
</script>
<?
    }
?>


</body>
</html>
