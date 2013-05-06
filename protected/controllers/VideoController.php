<?php

class VideoController extends AweController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Video;

        $this->performAjaxValidation($model, 'video-form');

		if(isset($_POST['Video']))
		{
			$model->attributes=$_POST['Video'];
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
	
		$this->actionVideo($id);

	}

	public function actionWatch($id)
	{
		$model=$this->loadModel($id);
		$partial = "player";
		$movie = $model->title;



        if (isset($_POST['ajax']) && $_POST['ajax'] === 'media-videos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }



        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.min.js'] = false
;            Yii::app()->clientScript->scriptMap['bootstrap.js'] = false;
            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial($partial, array(
                    'model' => $model, 'url' => $url_prefix . $model->filename, 'movie' => $model->title), true, true),
            ));
            exit;
        }
	
	}

	public function actionVideo($id) {

	  $model = Video::model()->findByPk($id);
	  if (isset($_POST['ajax']) && $_POST['ajax'] === 'media-videos-form') {
            echo CActiveForm::validate($model);
	    Yii::app()->end();
	  }


	  if (isset($_POST['Video'])) {
            $model->attributes = $_POST['Video'];
            $model->profile = (int) $_POST["Video"]["profile"];

            if ($model->validate()) {
	      if ($model->save()) {

		if (Yii::app()->request->isAjaxRequest) {

		  // Stop jQuery from re-initialization
		  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		  Yii::app()->clientScript->scriptMap['bootstrap.js'] = false;
		  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

		  echo CJSON::encode(array(
					   'status' => 'success',
					   'content' => "Created successfully",
					   ));
		  exit;
		}

		return;
	      }
            }
	  }


	  if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
	    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		  Yii::app()->clientScript->scriptMap['bootstrap.js'] = false;
            echo CJSON::encode(array(
				     'status' => 'failure',
				     'content' => $this->renderPartial('_video_file_details', array(
													      'model' => $model), true, true),
				     ));
            exit;
	  }
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
		$dataProvider=new CActiveDataProvider('Video');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Video('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];
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
		$model=Video::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
