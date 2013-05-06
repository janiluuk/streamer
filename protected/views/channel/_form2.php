<script type="text/javascript">
   function loadColorPreset(str) {

   var n=str.split(","); 

   $("#Channel_background_color").val(n[0].replace(" ", ""));
   $("#Channel_area_color").val(n[1].replace(" ", ""));
   $("#Channel_color").val(n[2].replace(" ", ""));
   $("#Channel_border_color").val(n[3].replace(" ", ""));
   $("#Channel_header_color").val(n[4].replace(" ", ""));


   }
   function updateColorOptions() {
     send();
	   updateDialog.close();



   }
   function updateColors() {

   $("#colors input").each(function() { var color= $(this).val(); $(this).css("background-color", "#"+color);});
   }
   $(document).ready(function() { 
       updateColors();


       var val = $("#template_select").val();
       if (!val) var val = "";

       $(".editor_template > div").attr("class", "custom_type"+val);       

   $("#template_select").change(function() { 
       var val = $(this).val();

       $(".editor_template > div").attr("class", "custom_type"+val);       
     } );
   $("#removeImage").click(function() { $('#image img').attr('src',  '/images/no.png'); $('#background_image').val(''); return false;});
   $(".editor_template select").change(function() { send(); });
 

   
     });


</script>
<div class="span-12 fl">

   <?php echo $form->dropDownListRow($model, 'channel_style', array('1' => 'Ulkoasu 1', '2' => 'Ulkoasu 2', '3' => 'Ulkoasu 3', '4' => 'Ulkoasu 4',  '5' => 'Ulkoasu 5'), array("id" => "template_select"));  ?>
   <?php echo $form->hiddenField($model, 'region1_content');?>

<div class="editor_template">
   <div class="custom_type1">
   <div id="block1">
   <?php echo $form->dropDownListRow($model, 'region1_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region1_style")); ?>

   
 <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/1" id="edit_area_1"><button onClick="return false"><i class="icon-edit"></i></button></a>
   </div>
   <div id="block2">
  <?php echo $form->dropDownListRow($model, 'region2_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region2_style")); ?>
   <?php echo $form->hiddenField($model, 'region2_content');?>
 <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/2" id="edit_area_2"><button onClick="return false"><i class="icon-edit"></i></button></a>

   </div>
   <div id="block3">
  <?php echo $form->dropDownListRow($model, 'region3_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region3_style")); ?>
   <?php echo $form->hiddenField($model, 'region3_content');?>
 <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/3" id="edit_area_3"><button onClick="return false"><i class="icon-edit"></i></button></a>

   </div>
   <div id="block4">
  <?php echo $form->dropDownListRow($model, 'region4_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region4_style")); ?>
   <?php echo $form->hiddenField($model, 'region4_content');?>

 <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/4" id="edit_area_4"><button onClick="return false"><i class="icon-edit"></i></button></a>
   </div>
   <div id="block5">
  <?php echo $form->dropDownListRow($model, 'region5_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region5_style")); ?>
  <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/5" id="edit_area_5"><button onClick="return false"><i class="icon-edit"></i></button></a>
   <?php echo $form->hiddenField($model, 'region5_content');?>
   
   </div>
   <div id="block6">
  <?php echo $form->dropDownListRow($model, 'region6_style', array('0' => 'Ei mitään', '1' => 'Video', '2' => 'Teksti', '3' => 'Kuva', '4' => 'Videolista'), array("id" => "region6_style")); ?>
   <?php echo $form->hiddenField($model, 'region6_content');?>
  <a class="update-dialog-open-link" href="/channel/editRegion/<?=$model->id;?>/6" id="edit_area_6"><button onClick="return false"><i class="icon-edit"></i></button></a>

   </div>
   </div>
</div>
</div>
<div class="span-8 fl">
<div class="span-6">   
   <?php echo $form->dropDownListRow($model, 'background_repeat', array('0' => 'Älä toista', '1' => 'Toista', '2' => 'Vaakasuunnassa', '3' => 'Pystysuunnassa')); ?>
<?php echo $form->dropDownListRow($model, 'background_style', array('0' => 'Alkuperäinen', '1' => 'Täytä sivun leveys', '2' => 'Täytä sivun korkeus', '3' => 'Venytä')); ?>
</div>
<div id="colors">
<div class="fl span-2">
		<?php echo $form->labelEx($model,'background_color'); ?>
                <?php 
   $this->widget('application.extensions.colorpicker.EColorPicker', 
		 array(
		       'name'=>'Channel[background_color]',
		       		       'value' => $model->background_color,
		       'mode'=>'textfield',
		       'fade' => false,
		       'slide' => false,
		       'curtain' => true,
		       )
		 );
 ?>
</div>
<div class="fl span-2">

		<?php echo $form->labelEx($model,'color'); ?>
                <?php 
   $this->widget('application.extensions.colorpicker.EColorPicker', 
		 array(
		       'name'=>'Channel[color]',
		       'value' => $model->color,
		       'mode'=>'textfield',
		       'fade' => false,
		       
		       'slide' => false,
		       'curtain' => true,
		       )
		 );
 ?>
</div>
<div class="fl span-2">

		<?php echo $form->labelEx($model,'area_color'); ?>
                <?php 
   $this->widget('application.extensions.colorpicker.EColorPicker', 
		 array(
		       'name'=>'Channel[area_color]',
		       'value' => $model->area_color,
		       'mode'=>'textfield',
		       'fade' => false,
		       
		       'slide' => false,
		       'curtain' => true,
		       )
		 );
 ?>
</div>
<div class="fl span-2">

		<?php echo $form->labelEx($model,'border_color'); ?>
                <?php 
   $this->widget('application.extensions.colorpicker.EColorPicker', 
		 array(
		       'name'=>'Channel[border_color]',
		       'value' => $model->border_color,
		       'mode'=>'textfield',
		       'fade' => false,		       
		       'slide' => false,
		       'curtain' => true,
		       )
		 );
 ?>
</div>
<div class="fl span-2">

		<?php echo $form->labelEx($model,'header_color'); ?>
                <?php 
   $this->widget('application.extensions.colorpicker.EColorPicker', 
		 array(
		       'name'=>'Channel[header_color]',
		       'value' => $model->header_color,
		       'mode'=>'textfield',
		       'fade' => false,		       
		       'slide' => false,
		       'curtain' => true,
		       )
		 );
 ?>
</div>
</div><div class="span-2 fl">
<a data-update-dialog-title="Valitse värimaailma" class="update-dialog-open-link" href="/channel/colorselector">
<button id="colorselector" class="btn" style="margin-top:30px"> Lataa värimaailma</button></a>
</div>

<div class="span-8">


<?php echo $form->labelEx($model,'background_image'); ?>
   <?php echo $form->hiddenField($model,'background_image', array("id" => "background_image")); ?>



<div id="image" style="width:300px"><a data-update-dialog-title="Valitse taustakuva" class="update-dialog-open-link" href="/channel/selectImage/<?=$model->id;?>">

<?
if ($model->background_image != "") {


  echo CHtml::image( $model->background_image, "", array("width" => 300));
  echo '<button id="removeImage" class="btn btn-danger" onClick="return false;" >Poista kuva</button>';
}
else echo CHtml::image("/images/no.png", "", array("style" => "width:300px;","width" => 300, "id" => "nopic"));

echo "</div>";
?></a>

<div class="clearfix" style="clear:both; max-width:300px;max-height:150px;">
<div id="uploadFile">
<?
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                 array(
                       'id'=>'uploadFiles',
                       'config'=>array(
                                       'action'=>'/channel/uploadImage',
                                       'allowedExtensions'=>array("jpg", "gif", "png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                       //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                       'onComplete'=>"js:function(id, fileName, responseJSON){  $('#image img').attr('src', '/files/" . Yii::app()->user->data()->username . "/Taustakuvat/'+fileName);   
     $('#background_image').val( '/files/".Yii::app()->user->data()->username."/Taustakuvat/'+fileName); send();

                                          $('#removeImage').fadeOut();
                                          
                                          $('<button id=\"removeImage\" class=\"btn btn-danger\" onClick=\"return false;\" >Poista kuva</button>').click(function() { $('#image img').attr('src',  '/images/no.png'); $('#background_image').val(''); $(this).fadeOut(); return false;}).appendTo(\"#image\");
	   
                                       
                                       }",
                                       //'messages'=>array(
                                       //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                       //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                       //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                       //                  'emptyError'=>"{file} is empty, please select files again without it.",
                                       //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                       //                 ),
                                       //'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      ));

?>
<script type="text/javascript">
  $(document).ready(function() {
  $("body").click(function() { updateColors(); });
    });
</script>
</div>
</div>
</div></div>