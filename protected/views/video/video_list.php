<?
$videos = Video::model();

$this->widget('bootstrap.widgets.TbGridView',array(

    'id'=>'project-gri',
    'dataProvider'=>$videos->search(),
    'afterAjaxUpdate'=>"function(id,    data){ 
  

     $('.addvid, .delvideo').unbind().click(function() { var id = $(this).attr('id'); 
       var cls = $(this).attr('class');
       var action = 'addvideo';
       if (cls == 'delvideo') action = 'deletevideo';
            $.get('/playlist/'+action+'/" . $model->id . "/'+id, function (data) { 
            $('#playlist').html(data);

        $('#project-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            items: 'tr',
            update : function () {
                serial = $('#project-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
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

);});}
",

    'rowCssClassExpression'=>'"items[]_{$data->id}"',
    'columns'=>array(
	array('type' => 'html', 'value' => '"<a class=\"update-dialog-open-link\" href=\"/video/watch/" . $data->id . "\"><img height=200 width=200 src=" . str_replace(" ", "%20", $data->thumbnail_url) . "></a>"'),

	array('type' => 'raw', 'value' => 'empty($data->title) ? "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->id . "\">" . substr(basename($data->filename),0,30) . "</a>" : "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->id . "\">" . $data->title . "</a>"'),

	'video_codec',
	'audio_codec',
	'video_width',
	'video_height',
    	array('type' => 'raw', 'value' => '"<div style=\"min-width:60px;\"><a href=\"#\" class=\"addvid\" value=\"Lisää\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/new.png\"></a> <a href=\"#\" class=\"delvid\" value=\"Poista\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/poista.png\"/></a></div>"'),


    ),
						  )); 

?>
