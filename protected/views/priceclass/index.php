<?php
$this->breadcrumbs = array(
	'Priceclasses',
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Create') . ' Priceclass', 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>
        <?= Yii::t('AweCrud.app', 'List') ?> <?= Priceclass::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</fieldset>