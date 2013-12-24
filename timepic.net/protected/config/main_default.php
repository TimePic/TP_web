<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TimePic',
	'defaultController' => 'index',
	'language'=>'zh_cn',
	'homeUrl' => 'http://test.timepic.net',
	'theme' => 'classic',
    'timeZone'=> 'Asia/Chongqing',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.helpers.*'
	),
	'aliases' => array(
		//assuming you extracted the files to the extensions folder
		'xupload' => 'ext.xupload',
	),


	'modules'=>array(
		// uncomment the following to enable the Gii tool
	/*	
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'xxxx',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
				'bootstrap.gii', // since 0.9.1
			),
		),
	*/
		//admin管理模板
		'admin' => array(
			'adminLayout'=> 'application.modules.admin.views.layouts.column2',	
		),
		'totorotalk',
        'chinchilla',
		'ieltseye' => array(
			'defaultController'=> 'Weibo',	
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'request' => array(
         		//'enableCsrfValidation'=>true,
			'enableCookieValidation'=>true,
        	),
		//需要在runtime中增加SESSION目录
		'session'=>array(
		   'autoStart'=>true,
		   'sessionName'=>'TimePic',
		   'cookieMode'=>'only',
//			去除 默认是/tmp 目录
//		   'savePath'=>'protected/runtime/SESSION/',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'urlSuffix' => '.html',
			'rules'=>array(
               //ieltseye
                'http://test.ieltseye.com'=>array('/ieltseye', 'urlFormat'=>'path', 'urlSuffix'=>'.html','showScriptName' => false,),
                'http://test.ieltseye.com/<_c:(topic)>/<_a:(tag)>/<tag:\w+>'=>array('ieltseye/<_c>/<_a>', 'urlFormat'=>'path', 'urlSuffix'=>'.html','showScriptName' => false,),
				'http://test.ieltseye.com/<controller:\w+>/<action:\w+>/page/<page:\d+>'=>array('ieltseye/<controller>/<action>', 'urlFormat'=>'path', 'urlSuffix'=>'.html', 'showScriptName' => false,),
				'http://test.ieltseye.com/<controller:\w+>/<id:\d+>'=>array('ieltseye/<controller>/view', 'urlFormat'=>'path', 'urlSuffix'=>'.html','showScriptName' => false,),
				'http://test.ieltseye.com/<controller:\w+>/<action:\w+>/<id:\d+>'=>array('ieltseye/<controller>/<action>', 'urlFormat'=>'path', 'urlSuffix'=>'.html', 'showScriptName' => false,),
				'http://test.ieltseye.com/<controller:\w+>/<action:\w+>'=>array('ieltseye/<controller>/<action>', 'urlFormat'=>'path', 'urlSuffix'=>'.html', 'showScriptName' => false,),
				'http://test.ieltseye.com/<controller:\w+>/'=>array('ieltseye/<controller>/index', 'urlFormat'=>'path', 'urlSuffix'=>'.html', 'showScriptName' => false,),
                
				'<controller:\w+>/<action:\w+>/page/<page:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=timepic',
			'emulatePrepare' => true,
			'username' => 'xxxxx',
			'password' => 'xxxxxx',
			'charset' => 'utf8',
			'tablePrefix' => 'tp_',
//			'enableProfiling'=>true
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, info',
					'categories'=>'timepic.*',
					//'filter'=>'CLogFilter',
					'logFile'=>'timepic.log',
				),
				array(
				    'class' => 'CFileLogRoute',
				    'levels' => 'trace, info',
				    'categories' => 'ieltseye.*',
				    //'filter'=>'CLogFilter',
				    'logFile' => 'ieltseye_web.log',
				),			
                array(
                    'class'=>'CProfileLogRoute',
                    'report'=>'summary',
                    // lists execution time of every marked code block
                    // report can also be set to callstack
                ),

				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'image'=>array(
				  'class'=>'application.extensions.image.CImageComponent',
					// GD or ImageMagick
					'driver'=>'GD',
					// ImageMagick setup path
					'params'=>array('directory'=>'/usr/local/bin'),
		),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
		'cache'=>array(
			'class'=>'system.caching.CApcCache',
		),
        'widgetFactory' => array(
            'widgets' => array(
                'CJuiDialog' => array(
                    'themeUrl' => '/css/jquery/JUI/themes',
                    'theme' => 'redmond',
                    'language'=>'cn',
                ),
                'CJuiDatePicker' => array(
                    'themeUrl' => '/css/jquery/JUI/themes',
                    'theme' => 'redmond',
                    'language'=>'cn',
                ),
            ),
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>  require_once(dirname(__FILE__).'/params.php'),
);
