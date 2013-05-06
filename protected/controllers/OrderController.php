<?php

class OrderController extends AweController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';



public function accessRules() {
	return array(
			array('allow',
			      'actions'=>array('index','view', 'purchase', 'verifypurchase','checkin','authorizeCode'),
				'roles'=>array('*'),

				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update'),
				'roles'=>array('UserCreator'),
				),
			array('allow', 
			      'actions'=>array('index','admin','delete','verifypurchase','view','authorizeCode','checkin'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	  if(Yii::app()->request->isAjaxRequest)	{	    
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false
;            Yii::app()->clientScript->scriptMap['bootstrap.js'] = false;
            echo CJSON::encode(array(
				     'status' => 'failure',
				     'content' => $this->renderPartial("view", array(
										     'model' => $this->loadModel($id)),true,true)));
	    
	  } else {
	    $this->render('view',array(
				       'model'=>$this->loadModel($id),
				       ));
	  }
	}

	public function actionAuthorizeCode($id) {

	  $channel_id = $id;
	  if (!$channel = Channel::model()->findByPk($channel_id)) throw new Exception("No such channel {$channel_id} found!");
	  if (!empty($_POST["Order"]["code"])) $code = $_POST["Order"]["code"];
	  else return false;


	  if ($order = Order::model()->validateCode($code)) {

	      $channel = $order->channel;
	      $channel->addAccess($order);

	      $this->renderPartial('refresh', array("channel" => $channel,"order" => $order),false, true);


	    } else {

	    $this->renderPartial("invalidcode", array());


	    }
	
	}
	    	    

	public function actionVerifyPurchase($id) {

	  $channel_id = $id;

	  $order = Order::model();

	  $this->performAjaxValidation($order, 'order-form');	  

	  
	  if (!$channel = Channel::model()->findByPk($channel_id)) throw new Exception("No such channel {$channel_id} found!");
	  if ($channel->priceclass->amount == 0) throw new Exception("Channel is free, no purchase possibl");
	  $order = Order::model();
	  $order->channel_id = $id;

	  if(Yii::app()->request->isAjaxRequest)	{	    
	  $this->renderPartial("order", array("model" => $order, "channel" => $channel));
	  }else {
	  $this->render("order", array("model" => $order, "channel" => $channel));
	  }

	}
	public function actionCheckIn() {

	  $ref = $_REQUEST["REFERENCE"];
	  $order = Order::model()->find("id={$ref}");
	  if ((int)$order->status ==2) {
	    $this->render("alreadyused", array("model" => $order));
	    exit();
	  }

	  $get = $_GET;
	  if ($order->validatePurchase($get)) {
	    $channel = $order->channel;
	    $channel->addAccess($order);
	    $order->status = $_REQUEST["STATUS"];
	    $get = $_REQUEST;
	    $order->transaction_data = serialize($get);

	    $order->save();

	    $this->render("success", array("model" => $order));
	  } else {
	    $this->render("failure", array("model" => $order));
	  }
	  
	}


	public function actionPurchase($id, $email="") {
	  

	  if (empty($email)) $email = $_POST["Order"]["email"];
	  if (empty($email)) return false;
	  
	  $channel_id = $id;


	  if (!$channel = Channel::model()->findByPk($channel_id)) throw new Exception("No such channel {$channel_id} found!");
	  $order = Order::model()->purchase($email,$channel_id);
	  $xml = $order->prepareCheckoutPurchase();

	  if(Yii::app()->request->isAjaxRequest)	{	    
	    $this->renderPartial("banks", array("xml" => $xml, "link" => $link, "order" => $order));
	  }
	  else 
	    $this->render("banks", array("xml" => $xml, "link" => $link, "order" => $order));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		$this->performAjaxValidation($model, 'order-form');

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$this->performAjaxValidation($model, 'order-form');

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
