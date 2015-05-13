<?php

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

    <?php $form = $this ->beginWidget('CActiveForm',
						array(
						    'id' => 'order',
						    'method'=>'post',
						    'action'=>MAIN .'order/adduser',
								//'enableClientValidation'=>true,
								//'clientOptions'=>array(
										//'validateOnSubmit'=>true,
								//),								
						)
					); ?>
      <div id="body" style="clear:left">
      <dl class="content">
        
        <!-- subject -->
        <dt>
          <?php echo $form -> label($order_model, 'subject'); ?>
          
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="subject" value=<?php echo $order_model['subject'] ; ?> />
          <?php echo $order_model['subject'] ; ?>
        </dd>  
             
             
        <!-- body -->
        <dt>
          <?php echo $form -> label($order_model, 'body'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="body" value=<?php echo $order_model['body'] ; ?> />
          <?php echo $order_model['body'] ; ?>
        </dd>
        
        <!-- order_id -->
        <dt>
          <?php echo $form -> label($order_model, 'ali_order_id'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="order_id" value=<?php echo $order_model['ali_order_id'] ; ?> />
          <?php echo $order_model['ali_order_id'] ; ?>
        </dd>
        <!-- 
          <?php echo $form -> textField($order_model,'ali_order_id',array('class'=>'tb_input')); ?>
          <?php echo $form ->error($order_model,'ali_order_id'); ?>
          <td><a href="javascript:;" onclick="delete_product(1)">删除</a></td>     
          -->                     
        
        <!-- out_trade_no -->
        <dt>
          <?php echo $form -> label($order_model, 'out_trade_no'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="out_trade_no" value=<?php echo $order_model['out_trade_no'] ; ?> />
          <?php echo $order_model['out_trade_no'] ; ?>
        </dd>
        
        <!-- merchant_name -->
        <dt>收款商户</dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="merchant_name" value=<?php echo $mercant_info['merchant_name'] ; ?> />
          <?php echo $mercant_info['merchant_name'] ; ?>                    
        </dd>
        
        <!-- merchant_email -->
        <dt>收款账户</dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="merchant_email" value=<?php echo $mercant_info['merchant_email'] ; ?> />
          <?php echo $mercant_info['merchant_email'] ; ?>
        </dd>
        
        <!-- price -->
        <dt>
          <?php echo $form -> label($order_model, 'price'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="price" value=<?php echo $order_model['price'] ; ?> />
          <?php echo $order_model['price'] ; ?>
        </dd>                    
        
        
        <!-- quantity -->
        <dt>
          <?php echo $form -> label($order_model, 'quantity'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="quantity" value=<?php echo $order_model['quantity'] ; ?> />
          <?php echo $order_model['quantity'] ; ?>
        </dd>                    
        
        
        <!-- logistics_fee -->
        <dt>
          <?php echo $form -> label($order_model, 'logistics_fee'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="logistics_fee" value=<?php echo $order_model['logistics_fee'] ; ?> />
          <?php echo $order_model['logistics_fee'] ; ?>
        </dd>                    
        
        
        <!-- logistics_type -->
        <dt>
          <?php echo $form -> label($order_model, 'logistics_type'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="logistics_type" value=<?php echo $order_model['logistics_type'] ; ?> />
          <?php echo $order_model['logistics_type'] ; ?>                    
        </dd>
        
        <!-- receive_name -->
        <dt>
          <?php echo $form -> label($order_model, 'receive_name'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="receive_name" value=<?php echo $order_model['receive_name'] ; ?> />
          <?php echo $order_model['receive_name'] ; ?>
        </dd>                    
        
        
        <!-- receive_mobile -->
        <dt>
          <?php echo $form -> label($order_model, 'receive_mobile'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="receive_mobile" value=<?php echo $order_model['receive_mobile'] ; ?> />
          <?php echo $order_model['receive_mobile'] ; ?>                    
        </dd>
        
        <!-- receive_address -->
        <dt>
          <?php echo $form -> label($order_model, 'receive_address'); ?>
        </dt>
        <dd>
          <span class="null-star">*</span>
          <input type="hidden" name="receive_address" value=<?php echo $order_model['receive_address'] ; ?> />
          <?php echo $order_model['receive_address'] ; ?>                    
        </dd>
        
        <span class="new-btn-login-sp">
          <!-- 
            <?php echo CHtml::link('确认支付宝付款', array('order/adduser','ali_order_id'=>$order_model['ali_order_id']), array('target'=>'_blank', 'class'=>"new-btn-login", 'style'=>"text-align:center;"));?>
           -->
          <?php echo CHtml::submitButton('确认支付宝付款', array('target'=>'_blank', 'class'=>"new-btn-login", 'style'=>"text-align:center;"));?>
        </span>
        
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