<script type="text/javascript">
   $(document).ready(function() { 
   $("#template_select").change(function() { 
       var val = $(this).val();
       $(".editor_template > div").attr("class", "custom_type"+val);       
     } );
     });

</script>
<div class="span-12">

<select id="template_select">
   <option value="1">Template 1</option>
   <option value="2">Template 2</option>
   <option value="3">Template 3</option>
   <option value="4">Template 4</option>
   <option value="5">Template 5</option>
</select>

<div class="editor_template">
   <div class="custom_type1">
       <div id="block1">
       <select id="area1"></select><button id="edit_area_1">E</button>
       </div>
       <div id="block2">
       <select id="area2"></select><button id="edit_area_2">E</button>
       </div>
       <div id="block3">
       <select id="area3"></select><button id="edit_area_3">E</button>
       </div>
       <div id="block4">
       <select id="area4"></select><button id="edit_area_4">E</button>
       </div>
       <div id="block5">
       <select id="area5"></select><button id="edit_area_5">E</button>
       </div>
       <div id="block6">
       <select id="area6"></select><button id="edit_area_6">E</button>
       </div>
   </div>
</div>
</div>
