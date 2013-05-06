<html>
<head>

<title><?=$title;?></title>
<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>



<style type="text/css">

/* Checkout */

.C1 {
width: 153px;
height: 110px;
border: 1pt solid #a0a0a0;
display: block;
float: left;
margin: 7px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
clear: none;
padding: 0;
}

.C1:hover {
  background-color: #f0f0f0;
  border-color: black;
 }

.C1 form {
width: 153px;
height: 110px;
}

.C1 form span {
display: table-cell;
  vertical-align: middle;
height: 92px;
width: 153px;
}

.C1 form span input {
  margin-left: auto;
  margin-right: auto;
display: block;
border: 1pt solid #f2f2f2;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
padding: 5px;
  background-color: white;
}

.C1:hover form span input {
border: 1pt solid black;
}

.C1 div {
  text-align: center;
  font-family: arial;
  font-size: 8pt;
}

<?

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
    
    
    if ($model->background_style=="0")echo "background-size: 100% !important;"; 
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
margin:0px;
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


	    if ($model->$style == "2") {
	      
	      echo "<div class=\"area\">" . $model->$content . "</div>";
	    }
	    if ($model->$style == "3") {

	      echo "<div class=\"area\">". CHtml::image($model->$content,"", array("style" => "max-height:120px")) . "</div>";
	    }
	    if ($model->$style == "1") {
	      echo "<div id=\"vid\">";
	      $this->renderPartial("/order/order", array("model" => Order::model(), "channel" => $model));
	      echo "</div>";

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

	



</body>
</html>
