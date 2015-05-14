<?php 
	$this->breadcrumbs = array(
				'管理员登陆' => '/admin/login'
			);
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<fieldset>
	<legend>管理员登陆</legend>
	<?php echo $form->errorSummary($admin_login);?>
	<?php echo $form->textFieldControlGroup($admin_login, 'username', array('placeholder'=>'请输入用户名'));?>
	<?php echo $form->passwordFieldControlGroup($admin_login, 'password', array('placeholder'=>'请输入登陆密码'));?>
	<?php echo $form->textFieldControlGroup($admin_login, 'verifyCode',array('placeholder'=>'验证码','size' => TbHtml::INPUT_SIZE_SMALL));?>
	<div style="padding-left: 110px;">
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一个','clickableImage'=>true )); ?>
	</div>		
	<?php echo $form->checkBoxControlGroup($admin_login, 'rememberMe');?>
</fieldset>
<?php echo TbHtml::formActions(array(
	TbHtml::submitButton('登陆', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton('重设'),
)); ?>
<?php $this->endWidget();?>