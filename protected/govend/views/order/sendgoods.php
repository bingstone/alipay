<?php 
	$this->breadcrumbs = array(
				'商户信息' => array('/order/index'),								
				'查看订单' => array('/order/orderview'),
				'商家发货'				
			);
?>
<fieldset>
	<legend>订单信息</legend>
	<?php echo TbHtml::well(					
		'<b>订单号：</b>'.$order_info->ali_order_id.
		'&nbsp&nbsp<b>交易号：</b>'.$order_info->out_trade_no.
		'<br/><b>商品名称：</b>'.$order_info->subject.
		'<br/><b>商品描述：</b>'.$order_info->body.
		'<br/><b>商品数量：</b>'.$order_info->quantity.
		'<br/><b>商品价格：</b>'.$order_info->price.
		'<br/><b>商品展示地址：</b><a href="'.$order_info->show_url.'" target="_blank">'.$order_info->show_url.'</a>
		<br/><b>付款类型：</b>'.$order_info->paytype->pay_type_info.
		'<br/><b>交易类型：</b>'.$order_info->tradetype->trade_type_info.
		'<br/><b>订单当前状态信息：</b>'.$order_info->orderstatus->status_info,
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>					
</fieldset>					
<fieldset>
	<legend>物流信息</legend>
	<?php echo TbHtml::well(					
		'<b>物流付款方式：</b>'.$order_info->logistics_payment.
		'&nbsp&nbsp&nbsp&nbsp<b>物流类型：</b>'.$order_info->logistics_type.
		'&nbsp&nbsp&nbsp&nbsp<b>物流费用：</b>'.$order_info->logistics_fee,
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>	
</fieldset>
<fieldset>
	<legend>收货信息</legend>
	<?php echo TbHtml::well(					
		'<b>姓名：</b>'.$order_info->receive_name.
		'&nbsp&nbsp&nbsp&nbsp<b>收货地址：</b>'.$order_info->receive_address.
		'&nbsp&nbsp&nbsp&nbsp<b>邮编：</b>'.$order_info->receive_zip.
		'<br/><b>联系电话：</b>'.$order_info->receive_mobile.
		'&nbsp&nbsp&nbsp&nbsp<b>固定电话：</b>'.$order_info->receive_phone,		
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>		
</fieldset>	
<fieldset>
	<legend>付款总额</legend>
	<?php $total = $order_info->price * $order_info->quantity + $order_info->logistics_fee;?>
	<?php echo TbHtml::well(					
		'<b>总金额：</b>'.$total.'元',	
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>	
</fieldset>	
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE, MERCHANT.'order/sendgoods'); ?>
    <fieldset>
    <legend></legend>
    <?php if (!empty($error_info)){
    	echo TbHtml::alert(TbHtml::ALERT_COLOR_ERROR, $error_info);
    }
 		echo TbHtml::label('物流号:', 'text');
     	echo TbHtml::textField('logisticsno', '', array('placeholder' => '请输入物流号'));?>  
     <input type=hidden name="order_id" value=<?php echo $order_info->ali_order_id; ?> >
    	<?php echo TbHtml::submitButton('确认发货'); ?>
    </fieldset>
<?php echo TbHtml::endForm(); ?>