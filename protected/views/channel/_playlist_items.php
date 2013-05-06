<script type="text/javascript">
   var time = "";
var playlist = "";


</script>
<div class="areaborder" style="text-align:center">
   <ul id="items" class="cliptable">
   <?
foreach ((array)$model->playlist->Items as $title) {                                                                                                                                                                                                                                            
  $thumb = $title->video->thumbnail_url;

  echo "<li class=\"item\"><a onclick=\"js:" . 'time = $f().getTime(); playlist=$f().getPlaylist(); ' . '$' . "f().setClip('mp4:" .str_replace("/www/citystream", "", str_replace(".mp4", "-800", str_replace("/Videot/", "/Videot/800/", $title->video->filepath))) . "'); " . '$f().onLastSecond(function() { $f().setPlaylist(playlist); $f().seek(time); $f().play(); }); ' . '$' . "f().play(); 


 return false;\"  href=\"". str_replace("/www/citystream", "",$title->video->filepath) . "\">" . CHtml::image($thumb, $title->video->title,array("width" => 90, "height" => 150)) . "</a>
<br>";

echo empty($title->video->title) ? $title->video->filename : $title->video->title;
echo "</li>";                   
 }

?></ul>
</div>
<script type="text/javascript">
    		  
	$.fn.easyPaginate = function(options){

		var defaults = {				
			step: 5,
			delay: 100,
			numeric: true,
			nextprev: true,
			auto:false,
			loop:false,
			pause:4000,
			clickstop:true,
			controls: 'pagination',
			current: 'current',
			randomstart: false
		}; 
		
		var options = $.extend(defaults, options); 
		var step = options.step;
		var lower, upper;
		var children = $(this).children();
		var count = children.length;
		var obj, next, prev;		
		var pages = Math.floor(count/step);
		var page = (options.randomstart) ? Math.floor(Math.random()*pages)+1 : 1;
		var timeout;
		var clicked = false;
		
		function show(){
			clearTimeout(timeout);
			lower = ((page-1) * step);
			upper = lower+step;
			$(children).each(function(i){
				var child = $(this);
				child.hide();
				if(i>=lower && i<upper){ setTimeout(function(){ child.fadeIn('fast') }, ( i-( Math.floor(i/step) * step) )*options.delay ); }
				if(options.nextprev){
					if(upper >= count) { next.fadeOut('fast'); } else { next.fadeIn('fast'); };
					if(lower >= 1) { prev.fadeIn('fast'); } else { prev.fadeOut('fast'); };
				};
			});	
			$('li','#'+ options.controls).removeClass(options.current);
			$('li[data-index="'+page+'"]','#'+ options.controls).addClass(options.current);
			
			if(options.auto){
				if(options.clickstop && clicked){}else{ timeout = setTimeout(auto,options.pause); };
			};
		};
		
		function auto(){
			if(options.loop) if(upper >= count){ page=0; show(); }
			if(upper < count){ page++; show(); }				
		};
		
		this.each(function(){ 
			
			obj = this;
			
			if(count>step){
								
				if((count/step) > pages) pages++;
				
				var ol = $('<ol id="'+ options.controls +'"></ol>').insertAfter(obj);
				
				if(options.nextprev){
					prev = $('<li class="prev"><img src="/img/gui/prev.png" alt="Previous"></li>')
						.hide()
						.appendTo(ol)
						.click(function(){
							clicked = true;
							page--;
							show();
						});
				};
				
				if(options.numeric){
					for(var i=1;i<=pages;i++){
					$('<li data-index="'+ i +'">'+ i +'</li>')
						.appendTo(ol)
						.click(function(){	
							clicked = true;
							page = $(this).attr('data-index');
							show();
						});					
					};				
				};
				
				if(options.nextprev){
					next = $('<li class="next"><img src="/img/gui/next.png" alt="Next"></li>')
						.hide()
						.appendTo(ol)
						.click(function(){
							clicked = true;			
							page++;
							show();
						});
				};
			
				show();
			};
		});	
		
	};	

   
   $(document).ready(function() { 
       
       $('ul#items').easyPaginate({
	 step: 5, auto:true, pause:10000, delay:50, loop:true
	     });
       
     });
 
</script>

