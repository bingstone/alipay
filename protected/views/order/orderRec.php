<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	  <title>订单正在处理</title>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
  <body>

<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//请在这里加上商户的业务逻辑程序代码

//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

//商户订单号

$out_trade_no = $_GET['out_trade_no'];

//支付宝交易号

$trade_no = $_GET['trade_no'];

//交易状态
$trade_status = $_GET['trade_status'];


if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
  //判断该笔订单是否在商户网站中已经做过处理
  //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
  //如果有做过处理，不执行商户的业务程序
}
else if($_GET['trade_status'] == 'TRADE_FINISHED') {
  //判断该笔订单是否在商户网站中已经做过处理
  //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
  //如果有做过处理，不执行商户的业务程序
}
else {
  echo "trade_status=".$_GET['trade_status'];
}

echo "接收成功<br />";
echo "trade_no=".$trade_no;

//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    echo '<br>'.'Animation Dialog Content'.'<br>';
    
?>
    </body>
</html>