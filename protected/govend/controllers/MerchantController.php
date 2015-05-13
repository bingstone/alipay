<?php
class MerchantController extends Controller
{
	public $layout = '//layouts/column2';
	
	public function actionmerchantInfo()
	{
		$merchant_model = Merchant::model();
		$merchant_info = $merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
		
		$this->render('merchantinfo',array('merchant_info'=>$merchant_info));
	}
}