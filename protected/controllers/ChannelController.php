<?php

class ChannelController extends AweController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

public function filters() {
	return array(
		     //		     			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view','watch'),
				'roles'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update'),
				'roles'=>array('UserCreator'),
				),
			array('allow', 
				'actions'=>array('admin','delete','watch'),
				'users'=>array('@'),
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
	  $model = $this->loadModel($id);
	  $playlist = $model->playlist;
	  
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'playlist' => $playlist
					   ));
	}

	public function actionSelectImage($id) {
	  

	  $channel = Channel::model()->findByPk($id);
	  $images = Image::model()->getAllImages();
	  
            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial("_image_selector", array(
                    'channel' => $channel, 'images' => $images), true, false),
            ));
            exit;




	}
        public function actionUploadImage()
        {
                Yii::import("ext.EAjaxUpload.qqFileUploader");
		$user = Yii::app()->user->data()->username;
                $folder='/www/citystream/files/' . $user . '/Taustakuvat/';// folder for uploaded files
                $allowedExtensions = array("jpg", "gif", "png");//array("jpg","jpeg","gif","exe","mov" and etc...
                $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload($folder);
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;// it's array
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Channel;

        $this->performAjaxValidation($model, 'channel-form');

		if(isset($_POST['Channel']))
		{
		Yii::app()->user->setFlash('success', '<strong>Kanava luotu!</strong>');

			$model->attributes=$_POST['Channel'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionColorSelector() {


            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial("color_list", array(
                    'channel' => $channel, 'region' => $id2), true, false),
            ));


	}

	public function getTabularFormTabs($form, $model, $video="")
	{
	  $tabs = array();
	  $count = 0;
	  $ordercount = count($model->orders);
	  foreach (array('basic'=>'Perustiedot', 'editor'=>'Ulkoasu', 'playlist' => 'Soittolista', 'orders' =>  'Tilaukset ('.$ordercount.')') as $ident => $title)
	    {
	 if ($model->id < 1 && $count > 0) continue;   
	      $tabs[] = array(
			      'active'=>$count++ === 0,
			      'label'=>$title,
			      'content'=>$this->renderPartial('_form' . $count, array('form'=>$form, 'model'=>$model, 'ident'=>$ident, 'video' => $video, 'title'=>$title), true),
			      );
	 
	    }
	    

	  return $tabs;
	}
	public function actionEditRegion($id, $id2) {
		if (Yii::app()->request->isAjaxRequest) {

		  // Stop jQuery from re-initialization
		  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;


	  $channel = Channel::model()->findByPk($id);
	  
            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial("_region_editor", array(
                    'channel' => $channel, 'region' => $id2), true, true),
            ));

            exit;
	  
		}
	}
	public function actionToggle($id) {

	  $channel = Channel::model()->findByPk($id);
	  if ($channel->status == 0) {
	    $channel->status = 1;
	    $channel->start();

	    $channel->save();
	  }

	  elseif ($channel->status == 1) { 
	    $channel->status = 0;
	    $channel->stop();
	    
	    $channel->save();

	  }

	  elseif ($channel->status == 2) { 
	    $channel->status = 0;
	    $channel->stop();
	    
	    $channel->save();

	  }

	  echo $channel->status;


	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		//		$this->performAjaxValidation($model, 'channel-form');
		$vmodel = Video::model();
		if(isset($_POST["Video"])) {

		  $vmodel->attributes = $_POST["Video"];
		  $vmodel->search();
		  
		}
		if(isset($_POST['Channel']))
		{
			$model->attributes=$_POST['Channel'];
			$model->playlist_id = $_REQUEST["Channel"]["playlist_id"];
			$model->background_image=$_POST['Channel']['background_image'];
			Yii::app()->user->setFlash('success', '<strong>Kanava tallennettu!</strong>');
			if($model->save()) {

			  if (Yii::app()->request->isAjaxRequest) {
			    
			  } else {
			    
			    $this->redirect(array('update','id'=>$model->id));
			  }
			  
			}
		} else

		$this->render('update',array(
			'model'=>$model,
			'video' => $vmodel
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionWatch($id)
	{
	  if ((int)$id <1 ) {
	  Yii::app()->clientScript->scriptMap = array(
						      '/css/style.css'     => false,
						      );

	    if ($channel = Channel::model()->find("identifier=:ch", array("ch" => $id))) { $id = $channel->id; }
	    if (!$channel) die("Kanavaa ei l&ouml;ytynyt");
	  }
	  $cs = Yii::app()->clientScript;
	  $cs->registerCssFile("/css/style.css");
	  $live = $_REQUEST["live"];
	  $this->layout = "channel";
	  $channel = Channel::model()->findByPk($id);
	  if (!$channel) die("Kanavaa ei l&ouml;ytynyt");
	  $sdp = $channel->getSdp();
	  $background = $channel->background_color;


	  if ($channel->checkAccess() === true) {


	  $this->render('watch',array(
				      'model'=>$this->loadModel($id), 'live' =>$live, 'sdp' => $sdp, 'bgcolor' => $background
				      )); 
	  } else {
	    $this->render('noaccess',array("model" => $this->loadModel($id)));

	  }

	}



	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Channel');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Channel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Channel']))
			$model->attributes=$_GET['Channel'];

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
		$model=Channel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='channel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
