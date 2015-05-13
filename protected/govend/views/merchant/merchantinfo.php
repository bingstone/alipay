<?php 
	$this->breadcrumbs = array(
				'个人信息',
			);
?>
<?php
$this->widget('yiiwheels.widgets.box.WhBox', array(
			'title' => '个人信息',
			'headerIcon' => 'icon-home',
			'content' =>'<p><b>注册信息</b></p>'.TbHtml::well(					
					'<table border="0" width="40%">
					  <tr>
					    <td><b>商户id：</b></td>
					    <td>'.$merchant_info['merchant_id'].'</td>
					  </tr>
					  <tr>
					    <td><b>资金金额：</b></td>
					    <td>'.$merchant_info['balance'].'</td>
					  </tr>
					  <tr>
					    <td><b>工商注册号：</b></td>
					    <td>'.$merchant_info['commerce_no'].'</td>
					  </tr>
					  <tr>
					    <td><b>商户邮件：</b></td>
					    <td>'.$merchant_info['merchant_email'].'</td>
					  </tr>
					  <tr>
					    <td><b>商户地址：</b></td>
					    <td>'.$merchant_info['merchant_address'].'</td>
					  </tr>
					  <tr>
					    <td><b>商户名称：</b></td>
					    <td>'.$merchant_info['merchant_name'].'</td>
					  </tr>
					  <tr>
					    <td><b>手机号码：</b></td>
					    <td>'.$merchant_info['merchant_phone'].'</td>
					  </tr>
					  <tr>
					    <td><b>交易数量：</b></td>
					    <td>'.$merchant_info['trade_amount'].'</td>
					  </tr>
					  <tr>
					    <td><b>交易金额：</b></td>
					    <td>'.$merchant_info['tarde_finance'].'</td>
					  </tr>
					 <tr>
					    <td><b>商户所属国家：</b></td>
					    <td>'.$merchant_info['merchant_country'].'</td>
					  </tr>
					 <tr>
					    <td><b>商户注册时间：</b></td>
					    <td>'.$merchant_info['merchant_addtime'].'</td>
					  </tr>
					 <tr>
					    <td><b>商户注册Ip地址：</b></td>
					    <td>'.$merchant_info['merchant_ip'].'</td>
					  </tr>
					</table>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
				),	
			)
		);
?>