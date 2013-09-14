<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'TimePicConsole',
    'preload'=>array('log'),
    // application components
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.helpers.*'
	),
    'components' => array(
        'db' => array(
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=timepic',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'lishuzu511',
            'charset' => 'utf8',
            'tablePrefix' => 'tp_'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace, info',
                    'categories' => 'ieltseye.*',
                    //'filter'=>'CLogFilter',
                    'logFile' => 'ieltseye.log',
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
	'params'=>  require_once(dirname(__FILE__).'/params.php'),
);