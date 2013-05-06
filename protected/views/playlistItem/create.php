<?php
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	'Create',
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.PlaylistItem::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Create') ?> PlaylistItem</legend>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?></fieldset>