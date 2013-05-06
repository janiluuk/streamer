<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Citystream',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'ext.giix-components.*',
		'application.components.*',
		'ext.awecrud.components.*',
		'application.modules.user.models.*'
	),


'modules'=> array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'f33nix0',
			'generatorPaths' => array('bootstrap.gii', 'ext.awecrud.generators'),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', '*'),
		),
		  'user' => array(
				  'debug' => false,
				  'userTable' => 'user',
				  'translationTable' => 'translation',
				  ),
		  'usergroup' => array(
				       'usergroupTable' => 'user_group',
				       'usergroupMessagesTable' => 'user_group_message',
				       ),
		  'membership' => array(
					'membershipTable' => 'membership',
					'paymentTable' => 'payment',
					),
		  'friendship' => array(
					'friendshipTable' => 'friendship',
					),
		  'profile' => array(
				     'privacySettingTable' => 'privacysetting',
				     'profileFieldTable' => 'profile_field',
				     'profileTable' => 'profile',
				     'profileCommentTable' => 'profile_comment',
				     'profileVisitTable' => 'profile_visit',
				     ),
		  'role' => array(
				  'roleTable' => 'role',
				  'userRoleTable' => 'user_role',
				  'actionTable' => 'action',
				  'permissionTable' => 'permission',
				  ),
		  'message' => array(
				     'messageTable' => 'message',
				     ),
		  ),
	// application components
	'components'=>array(
			    'widgetFactory' => array('widgets' => array(
									'TbGridView' => array('summaryText' => 'Yhteensä {count} kpl')
)),
			    'bootstrap' => array('class' => 'ext.bootstrap.components.Bootstrap'), // assuming you extracted bootstrap under extensions
		'user'=>array(
			      'class' => 'application.modules.user.components.YumWebUser',
			      'allowAutoLogin'=>true,
			      'loginUrl' => array('//user/user/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

	       
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
                        "site/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-\.]+)>/*" => 'site/<_c>/<_a>/',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\d+>/<id2:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			), */
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=citystream',
			'tablePrefix' => '',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'zxcvfdsA',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
			    'cache' => array(
					     					     'class' => 'CApcCache',
					     ), 
        'urlManager' => array(
            'showScriptName' => false,
            'urlSuffix' => '',
            'caseSensitive' => true,
            'urlFormat' => 'path',
            'rules' => array(

                        '<controller:\w+>/<id:\d+>' => '<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>/view',
                        '<controller:\w+>/<id:\d+>' => '<controller>/view',

                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>/<id:\d+>/<id2:\d+>' => '<controller>/<action>',
			'<controller:\w+>/<action:\w+>/<id:\d+>/<email>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>/<id:\w+>/<id2:\w+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>/<id:\d+>/<id2:\d+>' => '<controller>/<action>',			
                        '<controller:\w+>/<action:\w+>/<id:\d+>/<id2:\d+>/<type>' => '<controller>/<action>',
                        "site/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-\.]+)>/*" => 'site/<_c>/<_a>/',
                        //'api/<action:\w+>/<username:\w+>/<password:\w+>' => 'api/<action>',

                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

			'testikanava' => 'channel/watch/testikanava',
			     ),


			      ),



		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
			'merchantId' => 375917,
			'merchantKey' => 'SAIPPUAKAUPIAS',
			// this is used in contact page
			'adminEmail'=>'webmaster@example.com',
			'contentPath' => '/www/citystream/files/',
			),
);
