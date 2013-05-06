<div class="clearfix clear"></div>

	<div id="container_form1">
	<a href="#" onclick="$('#embed').toggle(); $('#live_preview').hide();updateEmbed(); return false;" >

		<div id="jaakanava" class="link_form1">
			<img src="/images/sharechannel.png"/>
			<div class="linkname_form1">Jaa kanava</div>

		</div>
		</a>

		<div class="container_form1_border"></div>

		<a href="#" onclick="$('#live_preview').toggle(); return false;">		
		<div id="livebroadcast" class="link_form1">
			<img src="/images/broadcast.png"/>
			<div class="linkname_form1">Luo suora lähetys</div>

		</div>
		</a>

	</div>


<div class="embed well" id="live_preview" style="display:none">
<div id="livefms" class="miniplayer" style="text-align:center"> <img src="http://flash.flowplayer.org/media/img/player/btn/play_large.png" alt="Play this video" /></div>
<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>
<script type="text/javascript">
  $(function() {
      $f("livefms", "/js/flowplayer/flowplayer-3.2.7.swf", {

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


	});
</script>
<div class="fl">
   <p>Aseta kameran osoitteeksi: <br/><strong>rtmp://citystream.tv/rtplive/<?=$model->identifier?>.sdp</strong></p>
</div>


<div class="clearfix clear"></div>
</div>
<div class="embed well" id="embed" style="display:none">
Anna koko:
<input id="width" type="text" size="3" style="width:30px;" value="450"> x
<input id="height" type="text" size="3" style="width:30px;" value="253">
<button class="btn" onclick="js:updateEmbed(); return false;">Päivitä koodi</button>
<p> Sisällytä seuraava koodi halutulle sivulle: </p>
<textarea id="embedcode" cols="120" style="width: 98%" rows="10"></textarea>
</div>
<script text="text/javascript">
function updateEmbed() {
       var code = '<object name="player" id="_fp_0.0970183270983398" width="450" height="253"    data="http://www.citystream.tv/js/flowplayer/flowplayer-3.2.7.swf"  type="application/x-shockwave-flash">    <param value="true" name="allowfullscreen"/>    <param value="always" name="allowscriptaccess"/>    <param value="transparent" name="wmode"/>    <param value="high" name="quality"/>    <param name="movie" value="http://www.citystream.tv/js/flowplayer/flowplayer-3.2.7.swf" />    <param value="config=%7B%22clip%22%3A%7B%22scaling%22%3A%22fit%22%2C%22url%22%3A%2212_Something_about_this_place.sdp%22%2C%22provider%22%3A%22rtmp%22%2C%22pageUrl%22%3A%22http%3A//www.citystream.tv/channel/update/12%22%2C%22buffer%22%3Afalse%7D%2C%22plugins%22%3A%7B%22rtmp%22%3A%7B%22netConnectionUrl%22%3A%22rtmp%3A//citystream.tv/rtplive%22%2C%22url%22%3A%22/js/flowplayer/flowplayer.rtmp-3.2.3.swf%22%7D%2C%22content%22%3A%7B%22url%22%3A%22http%3A//www.citystream.tv/js/flowplayer/flowplayer.content-3.2.0.swf%22%2C%22textDecoration%22%3A%22outline%22%2C%22top%22%3A0%2C%22border%22%3A0%2C%22width%22%3A'+$("#width").val()+'%2C%22backgroundGradient%22%3A%22none%22%2C%22backgroundColor%22%3A%22transparent%22%2C%22left%22%3A0%2C%22height%22%3A'+$("#height").val()+'%2C%22style%22%3A%7B%22body%22%3A%7B%22color%22%3A%22%23ffffff%22%2C%22fontSize%22%3A14%2C%22fontFamily%22%3A%22Arial%22%7D%7D%7D%2C%22viral%22%3A%7B%22share%22%3Afalse%2C%22url%22%3A%22/swf/flowplayer.viralvideos-3.2.13.swf%22%7D%2C%22controls%22%3A%7B%22borderRadius%22%3A24%2C%22opacity%22%3A1%2C%22time%22%3Afalse%2C%22top%22%3A%2295pct%22%2C%22scrubber%22%3Afalse%2C%22volumeBarHeightRatio%22%3A0.3%2C%22width%22%3A%22175%22%2C%22backgroundColor%22%3A%22%23000000%22%2C%22left%22%3A%2250pct%22%7D%7D%2C%22playlist%22%3A%5B%7B%22scaling%22%3A%22fit%22%2C%22url%22%3A%22<?=$model->getSdp(); ?>%22%2C%22provider%22%3A%22rtmp%22%2C%22buffer%22%3Afalse%7D%5D%2C%22canvas%22%3A%7B%22backgroundGradient%22%3A%5B0%2C0%2C0%2C0%2C0%2C0%5D%2C%22backgroundColor%22%3A%22%23000000%22%2C%22opacity%22%3A0.3%2C%22borderRadius%22%3A%220%22%2C%22border%22%3A%220px%22%7D%7D" name="flashvars"/></object>';
       $("#embedcode").val(code);
       return false;

     }

</script>

