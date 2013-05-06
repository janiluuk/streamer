<? 
$order = Order::model();

$this->widget('bootstrap.widgets.TbGridView',array(

    'id'=>'order-grid',

    'template' => '{summary}{pager}{items}{pager}',
    'type' => 'striped condensed',
	'dataProvider' => $order->search($model->id),
	'filter' => $order,
	'columns' => array(
        array('name' => 'valid_from', 'value' => 'date("d.m.y H:i", strtotime($data->created_at))'),
array('name' => 'valid_to', 'value' => 'date("d.m.y H:i", strtotime($data->valid_to))'),
	'amount',
        'email',
	'code',




        /*
        'payment_type',
        'amount',
        'created_at',
        array(
                    'name' => 'price_class_id',
                    'value' => 'isset($data->priceClass) ? $data->priceClass : null',
                    'filter' => CHtml::listData(Priceclass::model()->findAll(), 'id', Priceclass::representingColumn()),
                ),
        'transaction_data',
        'status',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			                'buttons'=>array(
        	      	'delete',
        		'view' => array( 'url'=> '"/order/view/" . $data->id', 'options'=> array("data-update-dialog-title" => "Tilauksen tiedot", "class" =>"update-dialog-open-link")),
	 		'update' => array('visible' => function() { return false; }),
	 		'delete' => array('visible' => function() { return false; }),
                	),

		),
	),
						   )); ?>
