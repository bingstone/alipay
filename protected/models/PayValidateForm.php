<?php
class PayValidateForm extends CFormModel{
	
	//public $pay_type_id;
	public $user_id;
	public $pay_type;
	public $pay_passwd;
	
	public function rules(){
		return array(
				array('pay_passwd','required','message'=>'请输入支付密码'),				
				array('pay_type', 'safe'),
				array('user_id', 'exist', 'allowEmpty'=>false, 
						'attributeName'=>'user_id', 'className'=>'application.models.Paypasswd', 
						'message'=>'没有注册付款密码，请先注册付款密码后再付款'),
				array('pay_passwd','checkpasswd'),
			);
	}
	
	public function attributeLabels(){
		return array(
				//'pay_type_id'=>'支付方式id',
				'pay_type'=>'支付类型',
				'pay_passwd'=>'支付密码'	,
			);
	}
	
	function checkpasswd(){
		if ($this->pay_type && $this->pay_type == 1){
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.user_id = :id');
			$criteria->params[':id'] = Yii::app()->userinfo->user_id;
			$criteria->addCondition('t.pay_passwd = :wd');
			$criteria->params[':wd'] = md5($this->pay_passwd);
			$passwd_info = Paypasswd::model()->find($criteria);		
			if (empty($passwd_info)){
				$this->addError('pay_passwd', '支付密码错误 ！！！');
			}
		}
	}
	
	public static function getPaytype(){
		$pay_type = Yii::app()->db->createCommand()->select('pay_type_id, pay_type_info')
		->from('{{PAY_TYPE}}')->queryAll();
		if (!empty($pay_type)){
			$pay_type = CHtml::listData($pay_type, 'pay_type_id', 'pay_type_info');
		}
		return $pay_type;
	}
	
	public function getPayConfig(){
		return array(
				//'title'=>'用户确认付款',				
				'showErrorSummary'=>true,
				'showErrors'=>true,
				'elements'=>array(
						'pay_type'=>array(
								'type'=>'dropdownlist',
								'items'=>PayValidateForm::getPaytype(),
						),
						'pay_passwd'=>array(
								'type'=>'password',
						)
				),
				'buttons'=>array(
						'submit'=>array(
								'type'=>'submit',								
								'label'=>'确认支付',
								//'attributes'=>array('color'=>TbHtml::BUTTON_COLOR_PRIMARY),
						),
				),
		);
	}
	
	public function getReceiptConfig(){
		return array(
				//'title'=>'用户确认收货',
				'showErrorSummary'=>true,
				'showErrors'=>true,
				'elements'=>array( 
						'pay_type'=>array(
								'type'=>'hidden',
								'value'=>1,
						),
						'pay_passwd'=>array(
								'type'=>'password',								
						)
				),
				'buttons'=>array(
						'submit'=>array(
								'type'=>'submit',
								'label'=>'确认收货',
						),
				),
		);
	}
}
?>