<?php
/* @var $this MerchantController */
/* @var $model Merchant */

$this->breadcrumbs=array(
	'Merchants'=>array('index'),
	$model->merchant_id,
);

$this->menu=array(
	array('label'=>'List Merchant', 'url'=>array('index')),
	array('label'=>'Create Merchant', 'url'=>array('create')),
	array('label'=>'Update Merchant', 'url'=>array('update', 'id'=>$model->merchant_id)),
	array('label'=>'Delete Merchant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->merchant_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Merchant', 'url'=>array('admin')),
);
?>

<h1>View Merchant #<?php echo $model->merchant_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'merchant_id',
		'balance',
		'merchant_passwd',
		'commerce_no',
		'merchant_email',
		'merchant_address',
		'merchant_name',
		'merchant_phone',
		'key_value',
		'merchant_country',
		'merchant_addtime',
		'merchant_ip',
	),
)); ?>
