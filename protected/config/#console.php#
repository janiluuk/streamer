<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.awecrud.components.*',
		'application.modules.user.models.*'
	),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=citystream',
			'tablePrefix' => '',
			'emulatePrepare' => true,
			'username' => 'citystream',
			'password' => 'xdr5432wS',
			'charset' => 'utf8',
		),
        'cache' => array(
            'class' => 'CApcCache',
        ), 

		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
			    ),
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'contentPath' => '/www/citystream/files/',
	),

);