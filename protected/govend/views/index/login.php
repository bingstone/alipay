<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
	
	    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
		<?php Yii::app()->bootstrap->register(); ?>	
	</head>
	
	<body>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<div style="margin-top: 10%; margin-right: 30%; margin-left: 30%">
<fieldset>
	<legend>商户登陆</legend>
	<?php echo $form->errorSummary($merchant_login);?>
	<?php echo $form->textFieldControlGroup($merchant_login, 'username', array('placeholder'=>'请输入用户名'));?>
	<?php echo $form->passwordFieldControlGroup($merchant_login, 'password', array('placeholder'=>'请输入登陆密码'));?>
	<?php echo $form->textFieldControlGroup($merchant_login, 'verifyCode',array('placeholder'=>'验证码','size' => TbHtml::INPUT_SIZE_SMALL));?>
	<div style="padding-left: 110px;">
		<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一个','clickableImage'=>true )); ?>
	</div>		
	<?php echo $form->checkBoxControlGroup($merchant_login, 'rememberMe');?>
</fieldset>
<?php echo TbHtml::formActions(array(
	TbHtml::submitButton('登陆', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton('重设'),
)); ?>
<?php $this->endWidget();?>
	</div>
	</body>
</html>