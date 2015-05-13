<?php 
	$this->breadcrumbs = array(
				'用户订单' => array('/user/orderview/type/all'),
				'确认付款',
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
	<?php echo TbHtml::well(					
		'<b>商家名称：</b>'.$order_info->merchant->merchant_name.
		'&nbsp&nbsp&nbsp&nbsp<b>商家邮箱地址：</b>'.$order_info->merchant->merchant_email.
		'&nbsp&nbsp&nbsp&nbsp<b>商家联系电话：</b>'.$order_info->merchant->merchant_phone,
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>				
	<?php echo TbHtml::well( 					
		'<b>物流付款方式：</b>'.$order_info->logistics_payment.
		'&nbsp&nbsp&nbsp&nbsp<b>物流类型：</b>'.$order_info->logistics_type.
		'&nbsp&nbsp&nbsp&nbsp<b>物流费用：</b>'.$order_info->logistics_fee,
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>
	<?php echo TbHtml::well(					
		'<b>姓名：</b>'.$order_info->receive_name.
		'&nbsp&nbsp&nbsp&nbsp<b>收货地址：</b>'.$order_info->receive_address.
		'&nbsp&nbsp&nbsp&nbsp<b>邮编：</b>'.$order_info->receive_zip.
		'<br/><b>联系电话：</b>'.$order_info->receive_mobile.
		'&nbsp&nbsp&nbsp&nbsp<b>固定电话：</b>'.$order_info->receive_phone,		
		array('size' => TbHtml::WELL_SIZE_SMALL)
	); ?>
	<?php $total = $order_info->price * $order_info->quantity ;?>
	<?php echo TbHtml::well(					
		'<b>总金额：</b>'.$total.'元',	
		array('size' => TbHtml::WELL_SIZE_SMALL) 
	); ?>
<div class="span6"> 
	<?php echo $form; ?>
</div>