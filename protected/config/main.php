<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'KHUSHAAL THAR',

	// preloading 'log' component
	'preload'=>array('log'),
	'timeZone' => 'Asia/Karachi',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'thar',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		/*'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"smtp.gmail.com",
            'Username'=>'khushaalthar1@gmail.com',
            'Password'=>'admin123!@#',
            'Mailer'=>'smtp',
            'Port'=>587,
            'SMTPAuth'=>true, 
            'SMTPSecure' => 'tls',
        ),*/
        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"smtp.yandex.ru",
            'Username'=>'info@khushaalthar.com',
            'Password'=>'yandexadmin1',
            'Mailer'=>'smtp',
            'Port'=>465,
            'SMTPAuth'=>true, 
            'SMTPSecure' => 'ssl',
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*'request' => array(
            'baseUrl' => 'http://192.168.1.7',
        ),*/
		

		// database settings are configured in database.php
		//'db'=>require(dirname(__FILE__).'/database.php'),

		//live
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=thar',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging' => true,
		),
		'dbrails' => array(
            'connectionString' => 'mysql:host=khushaalthar.com;dbname=khushaaldb',
            'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'DgS4aUmTXn',
			'charset' => 'utf8',
            'class'	=> 'CDbConnection'          // DO NOT FORGET THIS!
        ),

        //test
        /*'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=thar22',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging' => true,
		),
		'dbrails' => array(
            'connectionString' => 'mysql:host=localhost;dbname=thar22',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging' => true,
            'class'	=> 'CDbConnection'          // DO NOT FORGET THIS!
        ),*/
        
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
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
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);