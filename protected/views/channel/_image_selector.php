<script type="text/javascript">
   $(document).ready(function() { 

      
       $("#image_selector a").click(function() { 
	   var val = $(this).attr("href");
	   $("#image img").attr("src", val);
	$("#removeImage").remove();
	
	   $('<button id="removeImage" class="btn btn-danger" onClick="return false;" >Poista kuva</button>').click(function() { $('#image img').attr('src',  '/images/no.png'); $('#background_image').val(''); $(this).fadeOut(); return false;}).appendTo("#image");
	   
	   $("#background_image").val(val);
	   updateDialog.close();
	   
	   
	   return false;

	 } );
     });

</script>


<div id="image_selector">

<?
foreach ((array)$images as $id => $image) { 
  echo '<a href="' . $image . '" id="' . basename($image) . '"><img src="' . $image . '" width=160 width=100/></a>';
} 
?>

</div>
