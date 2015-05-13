<?php
/* @var $this MerchantController */
/* @var $model Merchant */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'merchant_id'); ?>
		<?php echo $form->textField($model,'merchant_id',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'balance'); ?>
		<?php echo $form->textField($model,'balance',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_passwd'); ?>
		<?php echo $form->textField($model,'merchant_passwd',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commerce_no'); ?>
		<?php echo $form->textField($model,'commerce_no',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_email'); ?>
		<?php echo $form->textField($model,'merchant_email',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_address'); ?>
		<?php echo $form->textField($model,'merchant_address',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_name'); ?>
		<?php echo $form->textField($model,'merchant_name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_phone'); ?>
		<?php echo $form->textField($model,'merchant_phone',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'key_value'); ?>
		<?php echo $form->textField($model,'key_value',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_country'); ?>
		<?php echo $form->textField($model,'merchant_country',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_addtime'); ?>
		<?php echo $form->textField($model,'merchant_addtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'merchant_ip'); ?>
		<?php echo $form->textField($model,'merchant_ip',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->