<?php
$this->breadcrumbs=array(
	'Soittolistat'=>array('admin'),
	$model->playlist_name,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Playlist::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Luo uusi').'', 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Päivitä'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
	array('label' => Yii::t('AweCrud.app', 'Aktivoi soittolista'), 'icon' => 'pencil', 'url' => array('generatePlaylist', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Poista'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Hallinnoi'), 'icon' => 'list-alt', 'url' => array('admin')),
);
$id = $model->id;



?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', '') ?><?= CHtml::encode($model) ?></legend>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?></fieldset>

<fieldset>

<div id="playlist">
<?
  $this->renderPartial("playlist", array("model" => $model, 'id' => $id), false, false);

?>
</div>

<h4>Kaikki videot</h4>

<?

$videos = Video::model();

$this->widget('bootstrap.widgets.TbGridView',array(

    'id'=>'project-gri',
    'dataProvider'=>$videos->search(),
    'afterAjaxUpdate'=>"function(id,data){ 
     $('.addvid, .delvideo').unbind().click(function() { var id = $(this).attr('id'); 


       var cls = $(this).attr('class');
var ths = $(this);
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

);});}
",

    'rowCssClassExpression'=>'"items[]_{$data->id}"',
    'columns'=>array(
	array('type' => 'html', 'value' => '"<a class=\"update-dialog-open-link\" href=\"/video/watch/" . $data->id . "\"><img height=200 width=200 src=" . $data->thumbnail_url . "></a>"'),

	array('type' => 'raw', 'value' => 'empty($data->title) ? "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->id . "\">" . basename($data->filename) . "</a>" : "<a class=\"update-dialog-open-link\" href=\"/video/video/" . $data->id . "\">" . $data->title . "</a>"'),

	'video_codec',
	'audio_codec',
	'video_width',
	'video_height',

    	array('type' => 'raw', 'value' => '"<div style=\"min-width:60px;\"><a href=\"#\" class=\"addvid\" value=\"Lisää\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/new.png\"></a> <a href=\"#\" class=\"delvideo\" value=\"Poista\" id=\"" . $data->id . "\"><img style=\"width:20px;\" width=20 height=20 src=\"/images/poista.png\"/></a></div>"'),


    ),
						  )); 

?>

