<?php 
	class WebUsers extends CWebUser{
		
		public function init()
		{
			parent::init();
			if( ! $this->getIsGuest()){
				$user_info = Yii::app()->db->createCommand()
				->select ('user_id,user_name, ali_email, ali_balance, ali_freeze,user_lastlogin')->from('{{USER}}')
				->where('user_name= :id', array(':id'=>$this->getName()))
				->queryRow();
				foreach($user_info as $_k=> $_v){
					Yii::app()->userinfo->$_k = $_v;
				}
			}
		}
	}
?>