<?php 
if($type==1)
{
	$this->breadcrumbs = array(
				//'管理员信息'=>array('/index/index'),
				'转账用户',
			);
}
elseif($type==2)
{
	$this->breadcrumbs = array(
			//'管理员信息'=>array('/index/index'),
			'转账商户',
	);
}
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<?php
if($type==1)
{
	$this->widget('yiiwheels.widgets.box.WhBox', array(
				'title' => '转账',
				'headerIcon' => 'icon-home',
				'content' =>'<p><b>转账用户</b></p>'.TbHtml::well(					
						'<table border="0" width="40%">
						  <tr height=50>
						    <td><b>用户名：</b></td>
						    <td>'.$transfer[user_name].'</td>
						  </tr>
						  <tr height=50>
						    <td><b>用户邮箱：</b></td>
						    <td>'.$transfer[ali_email].'</td>
						  </tr>
						 <tr height=50>
						    <td><b>转账金额：</b></td>
						    <td>'.$price.'</td>
						  </tr>
						<tr height=10>
							<td></td>
						</tr>
					
						</table>'
						,
						array('size' => TbHtml::WELL_SIZE_SMALL)
					).'<p><b>确认支付</b></p>'.TbHtml::well(					
					'<table border="0" width="40%">
					  <tr height=50>
					    <td><b>支付密码：</b></td>
					    <td><input type=password name=passwd ></td>
					   </tr>
						<tr>
							<td><span style="color:red"><b>'.$error.'</b></span></td>
							<td><input type=hidden name=transfer_id value='.$transfer[user_id].'>
								<input type=hidden name=price value='.$price.'>
							</td>							
						</tr>
					   <tr>
						    <td><input type=submit value=提交 style="height:30px;width:80px"></td>
						    <td><input type=reset value=重置 style="height:30px;width:80px"></td>
					   </tr>		  
					</table>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
				),	
				)
			);
}
elseif($type==2)
{
	$this->widget('yiiwheels.widgets.box.WhBox', array(
			'title' => '转账',
			'headerIcon' => 'icon-home',
			'content' =>'<p><b>转账商户</b></p>'.TbHtml::well(
					'<table border="0" width="40%">
					<tr height=50>
					<td><b>商户名：</b></td>
					<td>'.$transfer[merchant_name].'</td>
					</tr>
					<tr height=50>
					<td><b>商户邮箱：</b></td>
					<td>'.$transfer[merchant_email].'</td>
					</tr>
					<tr height=50>
					<td><b>转账金额：</b></td>
					<td>'.$price.'</td>
					</tr>
					<tr height=10>
					<td></td>
					</tr>
						
					</table>'
					,
					array('size' => TbHtml::WELL_SIZE_SMALL)
			).'<p><b>确认支付</b></p>'.TbHtml::well(
					'<table border="0" width="40%">
					<tr height=50>
					<td><b>支付密码：</b></td>
					<td><input type=password name=passwd ></td>
					</tr>
					<tr>
					<td><span style="color:red"><b>'.$error.'</b></span></td>
					<td><input type=hidden name=transfer_id value='.$transfer[merchant_id].'>
					<input type=hidden name=price value='.$price.'>
					</td>
					</tr>
					<tr>
					<td><input type=submit value=提交 style="height:30px;width:80px"></td>
					<td><input type=reset value=重置 style="height:30px;width:80px"></td>
					</tr>
					</table>',
					array('size' => TbHtml::WELL_SIZE_SMALL)
			),
	)
	);
}
else
	$this->render('transfer2',array('type'=>$type,'transfer'=>$transfer,'price'=>$_POST[price]));
?>
<?php $this->endWidget();?>