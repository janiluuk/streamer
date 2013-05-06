<?php
$this->breadcrumbs=array(
	"Soittolistat" => array('admin'),
	'Uusi',
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Playlist::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Uusi') ?> soittolista</legend>
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?></fieldset>