<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

$govend = dirname(dirname(__FILE__));
$frontend=dirname($govend);
Yii::setPathOfAlias('govend', $govend);
//Yii::setPathOfAlias('bootstrap', $frontend . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'bootstrap');
//Yii::setPathOfAlias('yiiwheels', $frontend . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'yiiwheels');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'name'=>'商家管理系统',
	'theme'=>'govend',
	'basePath' => $frontend,
	'viewPath' => $govend.'/views',
	'controllerPath' => $govend.'/controllers',
	'runtimePath' => $govend.'/runtime',

  //设置默认控制器
  'defaultController'=>'index/login',
    
	// preloading 'log' component
	'preload'=>array('log'),

	'aliases' => array(
		// yiistrap configuration
		'bootstrap' => realpath(__DIR__ . '/../../extensions/bootstrap'), // change if necessary
		// yiiwheels configuration
		'yiiwheels' => realpath(__DIR__ . '/../../extensions/yiiwheels'), // change if necessary
	),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'zii.widgets.jui',
		'govend.models.*',
		'govend.components.*',	
		'bootstrap.helpers.*',
		'bootstrap.behaviors.*',
		'bootstrap.components.*',
	),

	'modules'=>array(
		// 取消了Gii工具的注释
	'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','10.10.88.203','::1'),
			'generatorPaths' => array('bootstrap.gii'),
		),
    /**
	     * 添加新模块,不添加路由的时候找不到该模块
	     */
	  //'orderRec',
	  //'manage',
	    // 取消了Gii工具的注释		
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'MerchantUsers',
			'stateKeyPrefix'=>'merchant',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>MERCHANT.'index/login',
		),
		/* 'admin'=>array(
				'class'=>'AdminUsers',
				'stateKeyPrefix'=>'admin',
				'allowAutoLogin'=>false,
				'loginUrl'=>MANAGE.'admin/login',
		), */
		// uncomment the following to enable URLs in path-format
		
		  'urlManager'=>array(
			'urlFormat'=>'path',
			 /* 'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>', 
			),     */
		),
		
    //使用Alipay_Server中原先的数据库,注释掉第一个'db'=>array,解注释掉第二个
    /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=Ali_Server',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '1111',
			'charset' => 'utf8',
			'tablePrefix'=> 'ALI_'
		),
		
    //使用Alipay_Server中原先的数据库,注释掉第一个'db'=>array,解注释掉第二个
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'admin/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
			array(
					'class'=>'CWebLogRoute',
				), 
			),
		),
		'jump'=>array(
				'class'=>'ext.jumpage.jumpage',
				'successWait'=>2,//成功提示等待跳转时间，可以不指定，默认是2秒
				'errorWait'=>3, //错误信息等待跳转时间，同上，默认3秒
		),
		/* 'merchantinfo'=>array(
				'class' => 'govend.components.Merchantinfo',
		), */
		'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',   
        ),
		'yiiwheels' => array(
			'class' => 'yiiwheels.YiiWheels',
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);