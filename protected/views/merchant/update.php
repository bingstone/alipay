<?php
/* @var $this MerchantController */
/* @var $model Merchant */

$this->breadcrumbs=array(
	'Merchants'=>array('index'),
	$model->merchant_id=>array('view','id'=>$model->merchant_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Merchant', 'url'=>array('index')),
	array('label'=>'Create Merchant', 'url'=>array('create')),
	array('label'=>'View Merchant', 'url'=>array('view', 'id'=>$model->merchant_id)),
	array('label'=>'Manage Merchant', 'url'=>array('admin')),
);
?>

<h1>Update Merchant <?php echo $model->merchant_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>