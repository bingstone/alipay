<?php
/* @var $this MerchantController */
/* @var $model Merchant */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'merchant-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_passwd'); ?>
		<?php echo $form->textField($model,'merchant_passwd',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'merchant_passwd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commerce_no'); ?>
		<?php echo $form->textField($model,'commerce_no',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'commerce_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_email'); ?>
		<?php echo $form->textField($model,'merchant_email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'merchant_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_address'); ?>
		<?php echo $form->textField($model,'merchant_address',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'merchant_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_name'); ?>
		<?php echo $form->textField($model,'merchant_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'merchant_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_phone'); ?>
		<?php echo $form->textField($model,'merchant_phone',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'merchant_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key_value'); ?>
		<?php echo $form->textField($model,'key_value',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'key_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_country'); ?>
		<?php echo $form->textField($model,'merchant_country',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'merchant_country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_addtime'); ?>
		<?php echo $form->textField($model,'merchant_addtime'); ?>
		<?php echo $form->error($model,'merchant_addtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'merchant_ip'); ?>
		<?php echo $form->textField($model,'merchant_ip',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'merchant_ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->