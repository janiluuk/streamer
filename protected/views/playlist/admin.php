<?php
$this->breadcrumbs=array(
	'Soittolistat'=>array('index'),
	Yii::t('AweCrud.app', 'Hallinnoi'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'Listaa kaikki'), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Luo uusi') . ' ', 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('playlist-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'Hallinnoi soittolistoja') ?>    </legend>
<?= CHtml::link('<i class="icon-plus"></i> ' . Yii::t('AweCrud.app', 'Lisää uusi'), '/playlist/create', array('class' => 'add-button btn-success btn')) ?>
<?= CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Tarkka haku'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id' => 'playlist-grid',
    'type' => 'striped condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
	        array(
			'value'=>'"<a href=\"/playlist/view/" . $data->id . "\">" . $data->playlist_name . "</a>"',
			'type'=>'html',
		),
          
        array(
					'name' => 'active',
					'value' => '($data->active === 0) ? Yii::t(\'AweCrud.app\', \'Ei\') : Yii::t(\'AweCrud.app\', \'Kyllä\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'Ei'), '1' => Yii::t('AweCrud.app', 'Kyllä')),
					),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
					                'buttons'=>array(
        	      	'delete',
        		'view' => array('url' => '"/playlist/view/" . $data->id'),
	 		'update' => array('visible' => function() { return false; }),
                	),
		),
	),
)); ?>
</fieldset>