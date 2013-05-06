<?php
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->title) => array('view', 'id'=>$model->id),
	Yii::t('AweCrud.app', 'Update'),
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List').' '.Video::label(2), 'icon' => 'list', 'url' => array('index')),
	// array('label' => Yii::t('AweCrud.app', 'Create').' Video', 'icon' => 'plus', 'url' => array('create')),
	//array('label' => Yii::t('AweCrud.app', 'View'), 'icon' => 'eye-open', 'url'=>array('view', 'id' => $model->id)),
	array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
);
?>

<fieldset>
    <legend><?= Yii::t('AweCrud.app', 'Update') ?> Video <?= CHtml::encode($model) ?></legend>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?></fieldset>