<?php     
if (!empty($id)) {
  if ($playlist = Playlist::model()->find("id={$id}")) {
    echo "<h4>" . $playlist->playlist_name . "</h4>";
  }


}
	Yii::app()->clientScript->registerScriptFile('/js/jquery-ui.min.js', CClientScript::POS_END); 

$str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
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

     $('.removevideo').click(function(e) {  e.preventDefault();  var id = $(this).attr('id'); 
            $.get('/playlist/delvideo/" . $id . "/'+id, function (data) {
            $('#playlist').html(data);
            return false;
     });});

     $('.addvid, .delvideo').unbind().click(function(e) {  e.preventDefault();  var id = $(this).attr('id');
       var ths = $(this);
       var cls = $(this).attr('class');
       var action = 'addvideo';
       if (cls == 'delvideo') action = 'deletevideo';
            $.get('/playlist/'+action+'/" . $id . "/'+id, function (data) {
            if (action == 'deletevideo') $(ths).parent().parent().parent().fadeOut('slow');


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

);});

     


    ";




Yii::app()->clientScript->registerScript('sortable-project', $str_js, CClientScript::POS_READY);

$model = new PlaylistItem;
$model->playlist_id = $id;


$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'project-grid',
    'dataProvider'=>$model->search(),
    'rowCssClassExpression'=>'"items[]_{$data->id}"',
    'columns'=>array(

	array('type' => 'html', 'value' => '"<a data-update-dialog-title=\"" . $data->video->filename . "\" class=\"update-dialog-open-link\" href=\"/video/watch/" . $data->video->id . "\"><img height=100 width=100 src=" . str_replace(" ", "%20", $data->video->thumbnail_url) . "></a>"'),
	array('type' => 'raw', 'value' => 'empty($data->video->title) ? "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->video->id . "\">" . basename($data->video->filename) . "</a>" : "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->video->id . "\">" . $data->video->title . "</a>"'),
	'video.length',

    	array('type' => 'raw', 'value' => '"<div style=\"width:100%; text-align:right;\"><a class=\"removevideo\" id=\"" . $data->id . "\" href=\"#\"><i class=\"icon-trash\"></i></a></div>"'),
    ),
						  )); 
