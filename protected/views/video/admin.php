<?php
$this->breadcrumbs=array(
	'Videokirjasto'=>array('index'),
	Yii::t('AweCrud.app', 'Hallinnoi'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('video-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Videokirjasto') ?>   </legend>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'video-grid',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),
  'template' => '{summary}{pager}{items}{pager}',
	'filter' => $model,
	'columns' => array(

	array('type' => 'raw', 'value' => '"<a class=\"update-dialog-open-link\" data-update-dialog-title=\"" . $data->filename . "\" href=\"/video/watch/" . $data->id . "\"><img height=100 width=100 src=" . str_replace(" ", "%20", $data->thumbnail_url) . "></a>"'),
        array(
					'name' => 'status',
					'value' => 'Video::getStatus($data->status)',
					'filter' => Video::getStatus(),
					'type' =>'html',
	      ),
        array('name' => 'created_at', 'value' => 'date("d.m.y H:i", strtotime($data->created_at))'),
	//	array('name' => 'user_search', 'value' => '$data->user->username'),
        'title',
        'filename',
	/*      'filepath',  */
        'length',
        /*

        'language_id',
        'type',
        'bitrate',
        'framerate',
        'video_container',
        'video_codec',
        'audio_codec',
        'audio_samplerate',
        'video_width',
        'video_height',
        'length',
        'profile',
        'is_primary',
        'primary',

        array(
                    'name' => 'user_id',
                    'value' => 'isset($data->user) ? $data->user : null',
                    'filter' => CHtml::listData(YumUser::model()->findAll(), 'id', YumUser::representingColumn()),
                ),
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			
		
	                'buttons'=>array(
        	      	'delete',
        		'view' => array('visible' => function() { return false;}),
	 		'update' => array( 'options'=> array("data-update-dialog-title" => "Muokkaa videota", "class" =>"update-dialog-open-link")),
                	),
            
		
	),
))); ?>
</fieldset>