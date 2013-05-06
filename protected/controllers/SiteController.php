<?php

class SiteController extends Controller
{

    public function filters() {
      return array('apiContext', 'accessControl -login -logout -error');
    }

	public function actionWatch($id)
	{
	  if ((int)$id <1 ) {

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

	  $this->render('//channel/watch',array(
				      'model'=>$channel, 'live' =>$live, 'sdp' => $sdp, 'bgcolor' => $background
				      )); 
	  } else {
	    $this->render('//channel/noaccess',array("model" => $channel));

	  }

	}




	public function filterApiContext($filterChain) {
	  	  $host = explode(".", $_SERVER["HTTP_HOST"]);
	  if ($host[0] != "www" && $host[0] != "citystream") {   $this->actionWatch($host[0]); exit(); } // $this->redirect('/channel/watch/'.$host[0]);
	  
	  $filterChain->run();
	}


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/* File manager */

	public function actionLong() {
	
	$model = Channel::model()->findAll();
	
	$this->render('long', array("thingie" => $model));

		
	
	}
    public function actionFiles() {

        Yii::import("application.components.Filemanager.elFinder");
        Yii::import("application.components.Filemanager.elFinderConnector");
        Yii::import("application.components.Filemanager.elFinderVolumeLocalFileSystem");
        Yii::import("application.components.Filemanager.elFinderVolumeDriver");
	$opts = array(
		      'debug' => false,
		      'roots' => array(
				       array(
			'driver'        => 'LocalFileSystem',  // driver for accessing file system (REQUIRED)
			'path'          => "/www/cs/files/" . Yii::app()->user->data()->username,
			'URL'           => "http://citystream.vifi.ee/files/" . Yii::app()->user->data()->username,
			'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
		)
				       )
		      );

	// run elFinder
	$connector = new elFinderConnector(new elFinder($opts));
	$connector->run();

    }

	
	public function actionFile_manager() {
	  

	  $this->pageTitle = "File Manager";
	  $this->layout = "column1";
	  Yii::app()->clientScript->registerCssFile("/css/elfinder.min.css");
	  
	  if (Yii::app()->request->isAjaxRequest) {
		  // Stop jQuery from re-initialization
	    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	    Yii::app()->clientScript->scriptMap['bootstrap.js'] = false;
	    //	  Yii::app()->clientScript->registerScriptFile("/js/site/jquery.ui.min.js", CClientScript::POS_END);

            echo CJSON::encode(array(
				     'status' => 'success',
				     'content' => $this->renderPartial('file_manager', array(), true, true)
				     ));
	  } else {

	  Yii::app()->clientScript->registerScriptFile("/js/site/elfinder.min.js", CClientScript::POS_END);
	  Yii::app()->clientScript->registerScriptFile("/js/site/jquery.ui.min.js", CClientScript::POS_END);

            $this->render('file_manager');
	  }
	}

    /**
     * The script relies on a connector for the AJAX call.
     * The main function of this call is to return the directory
     * contents as a string.
     *
     * Place the following controller action in one of your controllers.
     * You can rename it whatever you wish, just remember to specify
     * the correct script parameter in the widget
     */

    public function actionFileBrowser() {
        $root = '/';

        $_POST['dir'] = urldecode($_POST['dir']);

        if (file_exists($root . $_POST['dir'])) {
            $files = scandir($root . $_POST['dir']);
            natcasesort($files);
            if (count($files) > 2) { /* The 2 accounts for . and .. */
                echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                // All dirs
                foreach ($files as $file) {
                    if (file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file)) {
                        echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
                    }
                }
                // All files
                foreach ($files as $file) {
                    if (file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file)) {
                        $ext = preg_replace('/^.*\./', '', $file);
                        echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
    }


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}