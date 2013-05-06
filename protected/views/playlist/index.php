<?php
$this->breadcrumbs = array(
	'Playlists',
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Create') . ' Playlist', 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'List') ?> <?= Playlist::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</fieldset>