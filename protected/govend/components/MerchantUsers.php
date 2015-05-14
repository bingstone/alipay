<?php 
	class MerchantUsers extends CWebUser{
		public function init()
		{
			parent::init();
			/* if( ! $this->getIsGuest()){
				$merchant_info = Yii::app()->db->createCommand()
				->select ('merchant_id, merchant_name, merchant_email, balance, commerce_no, merchant_phone')
				->from('{{MERCHANT}}')
				->where('merchant_email= :email', array(':email'=>$this->getName()))
				->queryRow();
				foreach($merchant_info as $_k=> $_v){
					Yii::app()->merchantinfo->$_k = $_v;
				}
			} */
		}
	}
?>