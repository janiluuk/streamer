<script type="text/javascript">
   $(document).ready(function() { 
       $("#save_region").click(function() { 
	   var data = CKEDITOR.instances.Channel_region<?=$region;?>_content.getData();
	   $("#Channel_region<?=$region;?>_content").attr("value", data);

	   updateDialog.close();
	   send();
	   
	   return false;

	 } );
     });

</script>
<div class="region_editor" id="<?=$region;?>">
<? $this->widget('ext.ckeditor.CKEditor', array(
								   'model'=>$channel,
								   'attribute'=>'region' . $region . '_content',
								   'language'=>'en',
								   'editorTemplate'=>'full',
								   )); ?>

<button class="button btn-success" onClick="return false;" id="save_region">
Tallenna
</button>
</div>




