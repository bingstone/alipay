<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//引入已经定义好的系统常量
require_once (dirname(__FILE__).'/protected/config/constant.php');

//引入自定义函数和类
require_once (dirname(__FILE__).'/protected/lib/classes/OrderReceive.php');
require_once (dirname(__FILE__).'/protected/lib/classes/OrderResponse.php');
require_once (dirname(__FILE__).'/protected/lib/classes/OrderBuild.php');
require_once (dirname(__FILE__).'/protected/lib/core.function/orderParameterHandle.php');
require_once (dirname(__FILE__).'/protected/lib/core.function/md5.php');

require_once($yii);
Yii::createWebApplication($config)->run();
