<?php
$this->breadcrumbs=array(
	"Kanavat" => array('admin'),
	'Luo uusi',
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Video::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Create') ?> Video</legend>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?></fieldset>