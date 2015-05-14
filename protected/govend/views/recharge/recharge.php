<?php

$this->breadcrumbs = array(

		'账户充值',
);
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<fieldset>
	<legned>账户充值</legned>
	
	<?php echo $form->textFieldControlGroup($user_recharge,'balance',array('help'=>'金额必须大于等于零','placeholder'=>'请输入充值金额'));?>

</fieldset>
	<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>
<?php $this->endWidget();?>
