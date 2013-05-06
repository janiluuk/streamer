<?php
$this->breadcrumbs = array(
	'Videos',
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Create') . ' Video', 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'List') ?> <?= Video::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</fieldset>