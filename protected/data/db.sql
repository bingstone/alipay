/***************************************************************
-- Database: ali_server
-- Date Created:
-- Version:V1.1
***************************************************************/

-- ---------------------------------------------------------------
-- create DB 'ali_server'
-- ---------------------------------------------------------------
DROP DATABASE IF EXISTS `Ali_Server`;
create database Ali_Server;

use Ali_Server;

-- ---------------------------------------------------------------
-- Table structure for `ALI_ADMIN`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_ADMIN`;
CREATE TABLE `ALI_ADMIN` (
  `admin_id` int(5) unsigned NOT NULL auto_increment,
  `admin_name` varchar(20) NOT NULL COMMENT '用户名',
  `admin_passwd` varchar(32) NOT NULL default '' COMMENT '密码',
	`ali_email` varchar(100) NOT NULL default 'admin@alipay.com' COMMENT '邮箱',
	`admin_addtime` datetime NOT NULL default '2000-01-01 00:00:00' COMMENT '注册时间',
  `admin_lastlogin` datetime NOT NULL default '2000-01-01 00:00:00' COMMENT '上次登录时间',
  `admin_lastip` varchar(100),
  `admin_type` tinyint(1) default 1,
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_USER`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_USER`;
CREATE TABLE `ALI_USER` (
  `user_id` int(16) NOT NULL auto_increment,
  `user_name` varchar(50) NOT NULL default '',
  `user_passwd` char(32) NOT NULL default '',
  `user_phone` char(11) default '13200010001',
  `ali_email` varchar(100) NOT NULL,
  `ali_type` tinyint(1) NOT NULL default 1,
  `ali_balance` decimal(20,2) NOT NULL default 0.01,
  `user_sex` tinyint(1),
  `user_ico` varchar(100),
  `user_birth` varchar(100),
  `user_country` varchar(255),
  `user_address` varchar(255),
  `user_lastlogin` datetime default '2000-01-01 00:00:00',
  `user_lastip` varchar(100),
  `user_addtime` datetime default '0001-01-01 00:00:00',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2088100100020000 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_USER` edit 2
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_USER`;
CREATE TABLE `ALI_USER` (
  `user_id` int(16) unsigned NOT NULL auto_increment,
  `user_name` varchar(50) NOT NULL default '',
  `user_passwd` char(64) NOT NULL default '',
  `user_phone` char(11) default '13200010001',
  `ali_email` varchar(100) NOT NULL,
  `ali_type` tinyint(1) NOT NULL default '1',
  `ali_balance` decimal(20,2) NOT NULL default '0.01',
  `user_sex` tinyint(1) default NULL,
  `user_ico` varchar(100) default NULL,
  `user_birth` date default NULL,
  `user_country` varchar(255) default NULL,
  `user_address` varchar(255) default NULL,
  `user_lastlogin` datetime default '2000-01-01 00:00:00',
  `user_lastip` varchar(100) default NULL,
  `user_addtime` datetime default '0001-01-01 00:00:00',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=200811 DEFAULT CHARSET=utf8;
-- ---------------------------------------------------------------
-- Table structure for `ALI_BANK`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_BANK`;
CREATE TABLE `ALI_BANK` (
  `bank_id` int(3) NOT NULL auto_increment,
  `bank_name` varchar(50) NOT NULL,
  `bank_info` varchar(100) NOT NULL default '',
  `ali_bank_port` varchar(100),
  PRIMARY KEY  (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Records of `ALI_BANK`
-- ---------------------------------------------------------------
INSERT INTO `ALI_BANK` VALUES ('1','China UnionPay','中国银联','');
INSERT INTO `ALI_BANK` VALUES ('2','BOC','中国银行','');
INSERT INTO `ALI_BANK` VALUES ('3','CCB','中国建设银行','');
INSERT INTO `ALI_BANK` VALUES ('4','ABOC','中国农业银行','');
INSERT INTO `ALI_BANK` VALUES ('5','ICBC','中国工商银行','');
INSERT INTO `ALI_BANK` VALUES ('6','bankcomm','交通银行','');
INSERT INTO `ALI_BANK` VALUES ('7','CUB','中国农村信用社','');
INSERT INTO `ALI_BANK` VALUES ('8','CMBC','中国民生银行','');
INSERT INTO `ALI_BANK` VALUES ('9','CMB','中国招商银行','');


-- ---------------------------------------------------------------
-- Table structure for `ALI_BANK_ACCOUNT`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_BANK_ACCOUNT`;
CREATE TABLE `ALI_BANK_ACCOUNT` (
  `account_id` int(20) NOT NULL auto_increment,
  `bank_id` int(3) NOT NULL,
  `user_id` int(16) NOT NULL,
  PRIMARY KEY  (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_MERCHANT`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_MERCHANT`;
CREATE TABLE `ALI_MERCHANT_KEY` (
  `key_id` int(11) NOT NULL auto_increment,
  `key_value` char(32) NOT NULL,
  `merchant_id` int(16) NOT NULL,
  PRIMARY KEY  (`key_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_MERCHANT` edit 2
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_MERCHANT`;
CREATE TABLE `ALI_MERCHANT` (
  `merchant_id` int(16) NOT NULL auto_increment,
  `balance` decimal(20,2) NOT NULL default '0.00',
  `commerce_no` varchar(16) default NULL,
  `merchant_email` varchar(64) NOT NULL,
  `merchant_address` varchar(64) NOT NULL,
  `merchant_name` varchar(64) NOT NULL,
  `merchant_phone` varchar(16) NOT NULL,
  `key_value` varchar(32) NOT NULL,
  `merchant_country` varchar(16) NOT NULL,
  `merchant_addtime` datetime NOT NULL,
  `merchant_ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`merchant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4001232 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_USER_SAFE`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_USER_SAFE`;
CREATE TABLE `ALI_USER_SAFE` (
  `safe_id` int(11) NOT NULL auto_increment,
  `user_id` int(16) NOT NULL,
  `safe_question` varchar(100) NOT NULL,
  `safe_answer` varchar(50) NOT NULL,
  PRIMARY KEY  (`safe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_ORDER`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_ORDER`;
CREATE TABLE `ALI_ORDER` (
  `ali_order_id` int(28) NOT NULL,
  `merchant_order_id` int(20) NOT NULL,
  `customer_id` int(16) NOT NULL,
  `merchant_id` int(16) NOT NULL,
  `trade_type_id` int(1) NOT NULL,
  `status_id` int(2) NOT NULL,
  `pay_type_id` int(1) NOT NULL,
  `pay_total` decimal(20,2) NOT NULL,
  `rec_addr_id` int(12),
  `ali_order_time` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`ali_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_ORDER` edit 2
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_ORDER`;
CREATE TABLE `ALI_ORDER` (
  `ali_order_id` INT(16) NOT NULL auto_increment,
  `merchant_order_id` INT(20) NOT NULL,
  `customer_id` INT(16) NOT NULL,
  `merchant_id` INT(16) NOT NULL,
  `trade_type_id` INT(1) NOT NULL DEFAULT 1,
  `status_id` INT(2) NOT NULL DEFAULT 1,
  `pay_type_id` INT(1) NOT NULL,
  `pay_total` DECIMAL(20,2) NOT NULL,
	`order_name` VARCHAR(20) NOT NULL,
	`order_detail` VARCHAR(50),
	`order_url` VARCHAR(100),
	`rec_name` VARCHAR(50) NOT NULL,
	`rec_zid_code` int(7) NOT NULL,
  `rec_addr` VARCHAR(100) NOT NULL,
	`rec_tel` INT(11),
	`rec_phone` int(11) NOT NULL,
  `ali_order_time` datetime NOT NULL default '2000-01-01 00:00:00',
  PRIMARY KEY  (`ali_order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=600700 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_ORDER` edit 3
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_ORDER`;
CREATE TABLE `ALI_ORDER` (
	`ali_order_id` int(16) NOT NULL auto_increment,  -- (新增)
	`out_trade_no` int(20) NOT NULL,  -- 卖家（商城）的订单号
	`buyer_email` varchar(100),  -- 买家的email
	`seller_email` varchar(100) NOT NULL,  -- 卖家的email
	`partner` int(16) NOT NULL,  --  卖家（商城）的ID号
	`trade_type_id` int(1) NOT NULL default '1', -- (新增)交易类型 默认为担保交易
	`status_id` int(2) NOT NULL default '1',  -- (新增)交易状态 新提交的订单默认为1
	`payment_type` int(1) NOT NULL default 1,  -- 支付宝支付还是银行支付
	`price` decimal(20,2) NOT NULL,  -- 交易价格
	`quantity` int(16) NOT NULL default 1,  -- 交易数量
	`logistics_payment` varchar(16) NOT NULL default 'SELLER_PAY', -- 物流的支付方式，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
	`logistics_type` varchar(16) NOT NULL default 'EXPRESS', -- 三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
	`logistics_fee` decimal(20.2),  -- 物流费用
	`logistics_no` int(16), -- 物流单号
	`subject` varchar(20) NOT NULL,  -- 商品名称
	`body` varchar(100) default NULL,  -- 商品描述
	`show_url` varchar(100) default NULL,  -- 商品展示页面
	`notify_url` varchar(160) NOT NULL,  -- 服务器异步通知页面路径
	`return_url` varchar(160) NOT NULL,  -- 页面跳转同步通知页面路径
	`receive_name` varchar(50) NOT NULL,  -- 收货人名称
	`receive_zip` int(7) NOT NULL,  -- 收货人邮编
	`receive_address` varchar(100) NOT NULL, -- 收货人地址
	`receive_phone` int(11) default NULL, -- 收货人电话
	`receive_mobile` int(11) NOT NULL, -- 收货人手机号
	`sign_type` varchar(16) NOT NULL default 'MD5',  -- 签名方式
	`sign` varchar(128) NOT NULL,  -- 签名值
	`_input_charset` varchar(16) default 'utf-8',  -- 编码方式
	`order_add_time` datetime NOT NULL default '2000-01-01 00:00:00',  -- (新增)订单提交时间
	`order_update_time` datetime NOT NULL default '2000-01-01 00:00:00',  -- (新增)订单更新时间
  PRIMARY KEY  (`ali_order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=600700 DEFAULT CHARSET=utf8;

-- ---------------------------------------------------------------
-- Table structure for `ALI_NOTICE` edit 1
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_NOTICE`;
CREATE TABLE `ALI_NOTICE` (
	`notify_id` varchar(100) NOT NULL COMMENT '通知号(字符串)',
	`order_id` int(16) NOT NULL COMMENT '订单号',
	`notify_type` varchar(20) NOT NULL default 'trade_status_sync' COMMENT '通知方式',
	`notify_info` varchar(20) NOT NULL COMMENT '通知内容',
	`is_success` int(1) NOT NULL default '0' COMMENT '是否通知到',
	`notify_send_time` datetime NOT NULL default '2000-01-01 00:00:00' COMMENT '通知发出时间',
	`notify_receive_time` datetime NOT NULL default '2000-01-01 00:00:00' COMMENT '通知被确认时间',
  PRIMARY KEY  (`notify_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ---------------------------------------------------------------
-- Table structure for `ALI_RECEIVE_ADDR`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_RECEIVE_ADDR`;
CREATE TABLE `ALI_RECEIVE_ADDR` (
  `rec_addr_id` int(12) NOT NULL auto_increment,
  `customer_id` int(16) NOT NULL,
  `rec_zid_code` int(10) NOT NULL,
  `rec_name` varchar(50) NOT NULL,
  `rec_phone` int(11) NOT NULL,
  `default_flag` tinyint(1) NOT NULL,
  `addr_state` varchar(20) NOT NULL,
  `addr_city` varchar(20) NOT NULL,
  `addr_area` varchar(20) NOT NULL,
  `addr_street` varchar(50) NOT NULL,
  `addr_house` varchar(100),
  PRIMARY KEY  (`rec_addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ---------------------------------------------------------------
-- Table structure for `ALI_ORDER_STATUS`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_ORDER_STATUS`;
CREATE TABLE `ALI_ORDER_STATUS` (
  `status_id` int(2) NOT NULL auto_increment,
  `status_name` varchar(100) NOT NULL,
  `status_info` varchar(200) NOT NULL,
  `final_flag` tinyint(1) NOT NULL,
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- ---------------------------------------------------------------
-- Records of `ALI_ORDER_STATUS`
-- ---------------------------------------------------------------
INSERT INTO `ALI_ORDER_STATUS` VALUES ('1','WAIT_BUYER_PAY','等待买家付款',0);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('2','CANCEL_BY_BUYER_BEFORE_PAY','买家付款前，买家取消订单',1);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('3','CANCEL_BY_SELLER_BEFORE_PAY','买家付款前，卖家取消订单',1);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('4','WAIT_SELLER_SEND_GOODS','买家已付款，等待卖家发货',0);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('5','WAIT_BUYER_SEND_GOODS','买家已付款，等待买家退货',0);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('6','WAIT_BUYER_CONFIRM_GOODS','卖家已发货，等待买家收货',0);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('7','WAIT_SELLER_CONFIRM_GOODS','买家已发货，等待卖家收货',0);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('8','TRADE_CANCEL_SUCCESS','卖家已收货，退货退款完成',1);
INSERT INTO `ALI_ORDER_STATUS` VALUES ('9','TRADE_FINISHED','买家已收货，交易完成',1);

-- ---------------------------------------------------------------
-- Table structure for `ALI_PAY_TYPE`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_PAY_TYPE`;
CREATE TABLE `ALI_PAY_TYPE` (
  `pay_type_id` int(1) NOT NULL auto_increment,
  `pay_type_name` varchar(50) NOT NULL,
  `pay_type_info` varchar(200) NOT NULL,
  PRIMARY KEY  (`pay_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- ---------------------------------------------------------------
-- Records of `ALI_PAY_TYPE`
-- ---------------------------------------------------------------
INSERT INTO `ALI_PAY_TYPE` VALUES ('1','ali','支付宝余额支付');
INSERT INTO `ALI_PAY_TYPE` VALUES ('2','bank','网银支付');

-- ---------------------------------------------------------------
-- Table structure for `ALI_TRADE_TYPE`
-- ---------------------------------------------------------------
DROP TABLE IF EXISTS `ALI_TRADE_TYPE`;
CREATE TABLE `ALI_TRADE_TYPE` (
  `trade_type_id` int(1) NOT NULL auto_increment,
  `trade_type_name` varchar(100) NOT NULL,
  `trade_type_info` varchar(200) NOT NULL,
  PRIMARY KEY  (`trade_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
-- ---------------------------------------------------------------
-- Records of `ALI_TRADE_TYPE`
-- ---------------------------------------------------------------
INSERT INTO `ALI_TRADE_TYPE` VALUES ('1','create_partner_trade_by_buyer','担保交易');
INSERT INTO `ALI_TRADE_TYPE` VALUES ('2','send_goods_confirm_by_platform','卖家提交发货信息');
INSERT INTO `ALI_TRADE_TYPE` VALUES ('3','create_direct_pay_by_user','即时到帐');
INSERT INTO `ALI_TRADE_TYPE` VALUES ('4','refund_fastpay_by_platform_pwd','即时到帐批量退款有密');
