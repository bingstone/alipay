<?php
/*****************************************************************************
 * 
 * @charset UTF-8
 * @author wulin
 * @time 2014-9-9
 *****************************************************************************/
 
/**
 * 设置系统常量
 */

//URL 路径
define('SITE_URL', '/Alipay_yii/');

define('CSS_URL',SITE_URL."assets/default/css/");    //前台样式目录地址
define('IMG_URL',SITE_URL."assets/default/img/");    //前台图片目录地址
define('MANAGE_CSS_URL',SITE_URL."assets/manage/css/");    //后台样式目录地址
define('MANAGE_IMG_URL',SITE_URL."assets/manage/img/");    //后台图片目录地址
define('USER_CSS_URL',SITE_URL."assets/user/css/");

define('MANAGE',SITE_URL."index.php/manage/");    //后台模块名字
define('MAIN',SITE_URL."index.php/");			//主模块名字

define('ADMIN',SITE_URL."backend.php/");   //backend后台app的名字
define('MERCHANT',SITE_URL."govend.php/");   //backend后台app的名字

//FILE 路径
/*
define('WEB_PATH',dirname(__FILE__).'/protected/');			//要进行修改的页面首级路径
define('LIB',WEB_PATH.'lib/');			//lib全局类和库函数
define('CLASSES',LIB.'classes/');			//全局类
define('CORE_FUNCTION',LIB.'core.function/');			//全局库函数
*/

//对订单进行处理的事件
define('PAY','BUYER_PAY_FOR_ORDER');         //※ 买家支付动作,WAIT_BUYER_PAY-->WAIT_SELLER_SEND_GOODS
define('SEND_S','SELLER_SEND_GOOD');           //卖家发货动作,WAIT_SELLER_SEND_GOODS-->WAIT_BUYER_CONFIRM_GOODS
define('RECEIVE','BUYER_CONFIRM_GOODS');     //※买家收货动作,WAIT_BUYER_CONFIRM_GOODS-->TRADE_FINISHED

define('SEND_B','BUYER_SEND_GOOD');        //买家提出退货请求并发货,WAIT_BUYER_CONFIRM_GOODS-->WAIT_SELLER_CONFIRM_GOODS
define('RECEIVE_SELLER','SELLER_CONFIRM_GOODS');        //买家退货并发货后,卖家收货动作,WAIT_SELLER_CONFIRM_GOODS-->TRADE_CANCEL_SUCCESS

define('C_B_B_P','CANCEL_BY_BUYER_BEFORE_PAY');        //买家未付款买家取消订单,WAIT_BUYER_PAY-->CANCEL_BY_BUYER_BEFORE_PAY
define('C_B_S_B_P','CANCEL_BY_SELLER_BEFORE_PAY');        //买家未付款卖家取消订单,WAIT_BUYER_PAY-->CANCEL_BY_SELLER_BEFORE_PAY
define('C_A_P_B_S','CANCEL_AFTER_PAY_BEFORE_SEND');        //买家付款后,卖家发货前,取消订单,WAIT_SELLER_SEND_GOODS-->TRADE_CANCEL_SUCCESS
define('C_A_S','CANCEL_AFTER_SEND');        //卖家发货后买家取消订单等待买家发货,WAIT_BUYER_CONFIRM_GOODS-->WAIT_SELLER_CONFIRM_GOODS



?>