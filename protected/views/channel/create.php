<?php
$this->breadcrumbs=array(
	"Kanavat" => array('admin'),
	'Luo kanava',
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Channel::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Hallinnoi'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Luo') ?> kanava</legend>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?></fieldset>