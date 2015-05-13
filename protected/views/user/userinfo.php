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
					    <td><b>用户Id：</b></td>
					    <td>'.$user_info['user_id'].'</td>
					  </tr>
					  <tr>
					    <td><b>用户名：</b></td>
					    <td>'.$user_info['user_name'].'</td>
					  </tr>
					  <tr>
					    <td><b>手机号码：</b></td>
					    <td>'.$user_info['user_phone'].'</td>
					  </tr>
					  <tr>
					    <td><b>电子邮箱：</b></td>
					    <td>'.$user_info['ali_email'].'</td>
					  </tr>
					  <tr>
					    <td><b>出生日期：</b></td>
					    <td>'.$user_info['user_birth'].'</td>
					  </tr>
					  <tr>
					    <td><b>所属国家：</b></td>
					    <td>'.$user_info['user_country'].'</td>
					  </tr>
					  <tr>
					    <td><b>注册地址：</b></td>
					    <td>'.$user_info['user_address'].'</td>
					  </tr>
					  <tr>
					    <td><b>注册时间：</b></td>
					    <td>'.$user_info['user_addtime'].'</td>
					  </tr>
					  <tr>
					    <td><b>最后登录时间：</b></td>
					    <td>'.$user_info['user_lastlogin'].'</td>
					  </tr>
					</table>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
				).'<p><b>资金信息</b></p>'.TbHtml::well(					
					'<table border="0" width="40%">
					  <tr>
					    <td><b>账户余额：</b></td>
					    <td>'.$user_info['ali_balance'].'</td>
						<td><b>冻结资金：</b></td>
						<td>'.$user_info['ali_freeze'].'</td>
					  </tr>					  
					</table>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
				).'<p><b>订单信息</b></p>'.TbHtml::well(					
					'<p>你总共有<b>'.$order_count.'</b>个订单,其中交易成功<b>'.$order_succes.'</b>个订单,交易进行中<b>'.$order_pross.'</b>个订单。</p>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
				),	
			)
		);
?>