<?php
/* @var $this MerchantController */
/* @var $data Merchant */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->merchant_id), array('view', 'id'=>$data->merchant_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_passwd')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_passwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commerce_no')); ?>:</b>
	<?php echo CHtml::encode($data->commerce_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_email')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_address')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_name')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_phone')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('key_value')); ?>:</b>
	<?php echo CHtml::encode($data->key_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_country')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_addtime')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_addtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('merchant_ip')); ?>:</b>
	<?php echo CHtml::encode($data->merchant_ip); ?>
	<br />

	*/ ?>

</div>