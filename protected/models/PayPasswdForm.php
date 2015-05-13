<?php
class PayPasswdForm extends CFormModel{
	
	public $user_id;	
	public $pay_passwd;
	public $pay_passwd2;	
	
	public function rules(){
		return array(
				array('pay_passwd','required','message'=>'请输入支付密码'),
				array('pay_passwd2','required','message'=>'请输入确认支付密码'),
				array('pay_passwd2','compare','compareAttribute'=>'pay_passwd','message'=>'两次密码输入不相等'),
				//array('user_id', 'exist', 'allowEmpty'=>false, 'attributeName'=>'user_id', 'className'=>'application.models.Paypasswd'),
				array('user_id', 'checkuserid')
			);
	}
	
	public function attributeLabels(){
		return array(
				'user_id'=>'用户id',
				'pay_passwd'=>'支付密码',
				'pay_passwd2'=>'确认支付密码',
			);
	}
	
	function checkuserid(){
		if ($this->user_id){
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.user_id = :id');
			$criteria->params[':id'] = $this->user_id;
			$passwd_info = Paypasswd::model()->find($criteria);
			if (!empty($passwd_info)){
				$this->addError('pay_passwd','用户已存在 ！！！');
			}
		}
		else
			$this->addError('pay_passwd','用户不存在！！！');
	}
	
	public function getPayPasswdConfig(){
		return array(
				'title'=>'用户付款密码',
				'showErrorSummary'=>true,
				'showErrors'=>true,
				'elements'=>array(
						'user_id'=>array(
								'type'=>'hidden',
								'value'=>$user_id,
						),
						'pay_passwd'=>array(
								'type'=>'password',
						),
						'pay_passwd2'=>array(
								'type'=>'password',
						),
				),
				'buttons'=>array(
						'submit'=>array(
								'type'=>'submit',
								'label'=>'确认',
						),
				),
		);
	}
}
?>