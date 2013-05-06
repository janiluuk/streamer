<div class="span-21">
<?
$playlist_id = $model->playlist_id;
$playlist = Playlist::model()->findByPk($playlist_id);
?>

<fieldset>
  
<div id="minifms" class="miniplayer" style="text-align:center"> <img src="http://flash.flowplayer.org/media/img/player/btn/play_large.png" alt="Toista video" /></div>
<script src="/js/flowplayer/flowplayer-3.2.6.min.js"></script>
<script type="text/javascript">
  $(function() {
      $f("minifms", "/js/flowplayer/flowplayer-3.2.7.swf", {
	play:null, 
	    
 
      

	    clip: {  
	  buffer: false,
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

<div id="playlistselector">
   <div id="selectplaylistchannel"><?= $form->dropDownListRow($model, 'playlist_id', CHtml::listData(Playlist::model()->findAll(), 'id', Playlist::representingColumn()), array('prompt' => Yii::t('AweApp', 'Ei soittolistaa'))) ?></div>
<div id="createplaylistchannel"><a id="585" value="Lisää" class="createplaylist" href="#"><img width="20" height="20" src="/images/new.png" style="width:20px;"> Luo uusi</a></div>
</div>
<div id="playlist_form" style="margin-top:20px;float:left">
</div>

<div class="clear clearfix"></div>

<div id="playlist">
<?
  $this->renderPartial("/playlist/playlist", array("model" => $playlist, 'id' => $playlist_id), false, false);

?>
</div>

<div class="clear clearfix"></div>
<h4>Kaikki videot</h4>
<div id="allvideos">
<?




$this->widget('bootstrap.widgets.TbGridView',array(

    'id'=>'project-gri',
    'dataProvider'=>$video->search(),
    'filter' => $video,
    'afterAjaxUpdate'=>"function(id,data){ 

     $('.addvid, .delvideo').unbind().click(function() { var id = $(this).attr('id'); 
       var cls = $(this).attr('class');
       var action = 'addvideo';
var ths = $(this);
       if (cls == 'delvideo') action = 'deletevideo';
            $.get('/playlist/'+action+'/" . $playlist_id . "/'+id, function (data) { 
  

            if (action == 'deletevideo') $(ths).parent().parent().parent().fadeOut('slow');

            $('#playlist').html(data);


        $('#project-grid table.itemss tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#project-grid table.items tbody').sortable('serialize', {key: 'itemss[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('//PlaylistItem/sort') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){

                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();



}

); return false; });}
",
    'template' => '{pager}{summary}{items}{pager}',
    'rowCssClassExpression'=>'"itemss[]_{$data->id}"',
    'columns'=>array(
	array('type' => 'html', 'value' => '"<a data-update-dialog-title=\"".$data->filename."\" class=\"update-dialog-open-link\" href=\"/video/watch/" . $data->id . "\"><img height=200 width=200 src=" . str_replace(" ", "%20", $data->thumbnail_url) . "></a>"'),

	array('type' => 'raw', 'name' => 'filename', 'value' => 'empty($data->title) ? "<a class=\"update-dialog-open-link\" data-update-dialog-title=\"".$data->filename."\" href=\"/video/video/" . $data->id . "\">" . substr(basename($data->filename),0,30) . "</a>" : "<a class=\"update-dialog-open-link\" data-update-dialog-title=\"".$data->title."\" href=\"/video/video/" . $data->id . "\">" . $data->title . "</a>"'),
	'length',
	'video_width',
	'video_height',
    	array('type' => 'raw', 'value' => '"<div style=\"min-width:60px;\"><a href=\"#\" class=\"addvid\" value=\"Lisää\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/new.png\"></a> <a href=\"#\" class=\"delvideo\" value=\"Poista\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/poista.png\"/></a></div>"'),


    ),
						  )); 

?>

</div></div>