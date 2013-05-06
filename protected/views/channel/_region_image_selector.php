<script type="text/javascript">
   $(document).ready(function() { 
       $("#image_selector a").each(function() { var src = $(this).attr("href");  if (src == $("#Channel_region<?=$region;?>_content").val()) { $(this).parent().addClass("selected");} });
       $("#image_selector a").click(function() { 
	   $(this).parent().addClass("selected");
	   var val = $(this).attr("href");
	   $("#Channel_region<?=$region;?>_content").attr("value", val);
	   send();

	   updateDialog.close();
	   return false;

	 } );
     });

</script>
<div id="image_selector">
<?
   $images = Image::getAllLogos();
if (empty($images))  echo "Lisää kuvia kirjastoon";

foreach ((array)$images as $id => $image) { 
  $i++;
  if ($i > 4) {$i = 0; $class = "clearfix"; } else $class = "";
  echo '<div class="imgItem ' . $class . '"><a href="' . $image . '" id="' . basename($image) . '"><img src="' . $image . '" width=120 height=100/></a></div>';
} 
?>

</div>


