<?php
//echo $id;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
	<title>支付宝标准双接口接口</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/assets/order/css/order.css");
?>
</head>
<body text=#000000 bgColor=#ffffff leftMargin=0 topMargin=4>
  <div id="main">
    <div id="head">
      <dl class="alipay_link">
        <a target="_blank" href="http://www.alipay.com/"><span>支付宝首页</span></a>|
        <a target="_blank" href="https://b.alipay.com/home.htm"><span>商家服务</span></a>|
        <a target="_blank" href="http://help.alipay.com/support/index_sh.htm"><span>帮助中心</span></a>
      </dl>
      <span class="title">支付宝标准双接口快速通道</span>
    </div>

    <div class="cashier-nav">
      <ol>
        <li class="current">1、确认信息 →</li>
        <li>2、点击确认 →</li>
        <li class="last">3、确认完成</li>
      </ol>
    </div>

    <!-- <form name=OrderUser action="order/checkuser" method=post target="_blank">
     -->
    <?php $form = $this ->beginWidget('CActiveForm', array('id'=>'OrderUser', 'method'=>'post', 'action'=>'checkuser')); ?>
      <div id="body" style="clear:left">
        <dl class="content">
          <dt><?php echo CHtml::label('支付宝账户：',false);?></dt>
          <dd>
            <span class="null-star">*</span>
            <!-- <input size="30" name="email" /> -->
            
            <?php echo CHtml::textField('email','',array('size'=>30));?>
            
            <span>必填</span>
          </dd>
          <dt><?php echo CHtml::label('支付密码：',false);?></dt>
          <dd>
            <span class="null-star">*</span>
            <!-- 
            <input size="30" name="pay_wd" />
             -->
            <?php echo CHtml::passwordField('pay_wd','',array('size'=>30));?>
            <span>支付密码,不是登录密码</span>
          </dd>
          <dt></dt>
          <dd>
            <input type="hidden" name="order_id" value=<?php echo $id;?> />
          </dd>
          <dt></dt>
          <dd>
            <span class="new-btn-login-sp">
              <!-- 
              <button class="new-btn-login" type="submit" style="text-align:center;">确 认</button>
              -->
              
              <?php echo CHtml::submitButton('提交',array('class'=>"new-btn-login", 'style'=>"text-align:center;")); ?>
            </span>
          </dd>
        </dl>
      </div>
    <?php $this -> endwidget(); ?> 
    
    <div id="foot">
      <ul class="foot-ul">
        <li><font class="note-help">如果您点击“确认”按钮，即表示您同意该次的执行操作。 </font></li>
        <li>支付宝版权所有 2011-2015 ALIPAY.COM</li>
      </ul>
		</div>
  </div>
</body>
</html>