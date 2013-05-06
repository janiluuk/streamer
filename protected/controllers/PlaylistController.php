<?php

class PlaylistController extends AweController
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
	        $this->performAjaxValidation($model, 'playlist-form');
	$model = $this->loadModel($id);
	
		if(isset($_POST['Playlist']))
		{
			$model->attributes=$_POST['Playlist'];
			Yii::app()->user->setFlash('success', '<strong>Soittolista tallennettu!</strong>');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'id' => $id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 */

	public function actionCreate()
	{
		$model=new Playlist;

        $this->performAjaxValidation($model, 'playlist-form');

		if(isset($_POST['Playlist']))
		{
			$model->attributes=$_POST['Playlist'];
			$model->user_id = Yii::app()->user->data()->id;
			Yii::app()->user->setFlash('success', '<strong>Soittolista luotu!</strong>');
			if($model->save()) {
			  if (Yii::app()->request->isAjaxRequest) {

			    // Stop jQuery from re-initialization
			    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
			    echo $model->id;
			    Yii::app()->end();

			  } else {
			    $this->redirect(array('view','id'=>$model->id));
			  }
			}
		}

		if (Yii::app()->request->isAjaxRequest) {

		  // Stop jQuery from re-initialization
		  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('_miniform',array(
			'model'=>$model,
					     ));
 
		} else
		$this->render('create',array(
			'model'=>$model,

					     ));
	}

	public function actionAssign($id, $id2) {
			  // Stop jQuery from re-initialization
		  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;


	  $playlist = Playlist::model()->find("id={$id}");
	  $channel = Channel::model()->find("id={$id2}");
	  $channel->playlist_id = $playlist->id;
	  $channel->save();

	  $playlistItem = new PlaylistItem;

	  $this->renderPartial("playlist", array("model" => $playlistItem, "id" => $id), false, true);
	  
	}


	public function actionAddVideo($id, $id2) {
			  // Stop jQuery from re-initialization
		  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;


	  $playlist = Playlist::model()->find("id={$id}");
	  $video = Video::model()->find("id={$id2}");
	  
	 
	  $playlistItem = new PlaylistItem();
	  $playlistItem->playlist_id = $id;
	  $playlistItem->video_id = $id2;
	  $playlistItem->save();
	  $this->renderPartial("playlist", array("model" => $playlistItem, "id" => $id), false, true);
	  
	}


	public function actionDelVideo($id, $id2) {
			  // Stop jQuery from re-initialization
	  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;


	  $playlistItem = PlaylistItem::model()->find("id={$id2}");
	  $playlistItem->delete();
	  $playlistItem = new PlaylistItem();
	  
	  $this->renderPartial("playlist", array("model" => $playlistItem, "id" => $id), false, true);


	}

	public function actionDeleteVideo($id, $id2) {
			  // Stop jQuery from re-initialization
	  Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	  Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;


	  $video = Video::model()->find("id={$id2}");
	  $video->delete();
	  Yii::app()->user->setFlash('success', '<strong>Video poistettu!</strong>');
	  if ($playlistItem = PlaylistItem::model()->findAll("video_id={$id2}")) {
	    foreach ((array)$playlistItem as $item) {
	      $item->delete();
	    }
	  }
	  $playlistItem = new PlaylistItem;

	  $this->renderPartial("playlist", array("model" => $playlistItem, "id" => $id), false, true);



	}

	public function actionGeneratePlaylist($id) {

	  $model = new Playlist;

	  $playlist = Playlist::model()->with("Items")->find("t.id={$id}",array('order'=>'order'));

	  $playlist->generatePlaylistFile();
	  Yii::app()->user->setFlash('success', '<strong>Soittolista luotu!</strong>');


	  
	  $this->render("playlist", array("model" => $model), false, true);

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $this->performAjaxValidation($model, 'playlist-form');

		if(isset($_POST['Playlist']))
		{
			$model->attributes=$_POST['Playlist'];
			Yii::app()->user->setFlash('success', '<strong>Soittolista tallennettu!</strong>');
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
		$dataProvider=new CActiveDataProvider('Playlist');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Playlist('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Playlist']))
			$model->attributes=$_GET['Playlist'];

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
		$model=Playlist::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='playlist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
