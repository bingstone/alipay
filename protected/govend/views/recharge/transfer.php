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
						    <td><b>用户名或邮箱：</b></td>
						    <td><input type=text name=transfer style=width:40></td>
						  </tr>
						  <tr height=50>
						    <td><b>确认用户名或邮箱：</b></td>
						    <td><input type=text name=transfer2 style=width:40></td>
						  </tr>
						  <tr height=50>
						    <td><b>转账金额：</b></td>
						    <td><input type=text name=price style=width:40></td>
						  </tr>
						<tr height=10>
							<td></td>
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
if($type==2)
{
	$this->widget('yiiwheels.widgets.box.WhBox', array(
			'title' => '转账',
			'headerIcon' => 'icon-home',
			'content' =>'<p><b>转账商户</b></p>'.TbHtml::well(
					'<table border="0" width="40%">
					<tr height=50>
					<td ><b>商户名或邮箱：</b></td>
					<td><input type=text name=transfer style=width:40></td>
					</tr>
					<tr height=50>
					<td><b>确认商户名或邮箱：</b></td>
					<td><input type=text name=transfer2 style=width:40></td>
					</tr>
					<tr height=50>
					<td><b>转账金额：</b></td>
					<td><input type=text name=price style=width:40></td>
					</tr>
					<tr height=10>
					<td></td>
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
// else
// 	$this->render('transfer',array('type'=>$type));
?>
<?php $this->endWidget();?>

