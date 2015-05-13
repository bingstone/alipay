<?php 
	$this->breadcrumbs = array(
			'管理员信息' => array('/index/index'),
			'查看管理员' => array('/manager/showadmin'),
			'更新管理员信息',
	);
?>

        
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'admin-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<fieldset>
	<legend>注册管理员</legend>
	<?php echo $form->errorSummary($admin_info);?>
	<?php echo $form->textFieldControlGroup($admin_info, 'admin_name', array('placeholder'=>'请输入管理员名'));?>
	<?php echo $form->passwordFieldControlGroup($admin_info, 'admin_passwd', array('placeholder'=>'请输入登陆密码'));?>
	<?php echo $form->passwordFieldControlGroup($admin_info, 'passwd2', array('placeholder'=>'请输入确认登陆密码'));?>
	<br/>	
	<?php //echo $form->textFieldControlGroup($user_info, 'user_phone',array('placeholder'=>'请输入用户手机号码'));?>
	<?php echo $form->textFieldControlGroup($admin_info, 'ali_email', array('prepend' => '@', 'placeholder'=>'请输入邮件地址')); ?>
	<br/>
	<br/>
    <br/><br/>
  	
 </fieldset>
<?php echo TbHtml::formActions(array(
	TbHtml::submitButton('注册', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton('重设'),
)); ?>
<?php $this->endWidget();?>
			