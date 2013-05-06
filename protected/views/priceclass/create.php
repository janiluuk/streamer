<?php
$this->breadcrumbs=array(
	"Hintaluokat" => array('index'),
	'Luo uusi',
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Priceclass::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Luo uusi') ?> hintaluokka</legend>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?></fieldset>