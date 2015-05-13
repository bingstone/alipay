<?php

/**
 * This is the model class for table "{{MERCHANT}}".
 *
 * The followings are the available columns in table '{{MERCHANT}}':
 * @property string $merchant_id
 * @property string $balance
 * @property string $merchant_passwd
 * @property string $commerce_no
 * @property string $merchant_email
 * @property string $merchant_address
 * @property string $merchant_name
 * @property string $merchant_phone
 * @property string $key_value
 * @property string $merchant_country
 * @property string $merchant_addtime
 * @property string $merchant_ip
 */
class Merchant extends CActiveRecord
{
	
	public $passwd2;
	public $start_balance;
	public $end_balance;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{MERCHANT}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_name', 'required', 'message'=>'请输入商户名称'),
			array('merchant_name', 'unique', 'message'=>'商户名已存在'),
			array('merchant_passwd', 'required', 'message'=>'请输入登录密码'),
			array('merchant_passwd', 'length', 'min'=>5, 'message'=>'请输入不少于5位的密码 '),
			array('passwd2', 'required', 'message'=>'请输入确认密码'),
			array('passwd2', 'length', 'min'=>5, 'message'=>'请输入不少于5位的密码 '),
			array('passwd2','compare','compareAttribute'=>'merchant_passwd','message'=>'两次输入密码不一致'),
			array('merchant_email', 'required','message'=>'请输入邮件地址'),
			array('merchant_email', 'email', 'allowEmpty'=>false, 'message'=>'请输入正确的邮件地址'),
			array('merchant_email', 'unique', 'message'=>'此邮件地址已存在'),
			array('balance', 'numerical', 'allowEmpty'=>false, 'message'=>'不能包含非法字符'),
			array('merchant_passwd, merchant_email, merchant_address, merchant_name', 'length', 'max'=>64, 'message'=>'请输入合适的长度'),
			array('merchant_phone', 'required','message'=>'请输入手机号码'),
			//array('merchant_phone', 'match', 'pattern'=>'/^86\d{13}$/', 'message'=>'手机号码格式错误'),
			array('commerce_no', 'length', 'max'=>16, 'message'=>'商户号过长'),
			array('merchant_country', 'required','message'=>'请选择所属国家'),
			array('merchant_address', 'required','message'=>'请输入商户所在地址'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('merchant_id, commerce_no,trade_amount, tarde_finance, key_value, merchant_addtime, merchant_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'order'=>array(self::HAS_MANY, 'Order', 'partner', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'merchant_id' => '商户id',
			'balance' => '资金金额',
			'merchant_passwd' => '商户密码',
			'commerce_no' => '工商注册号',
			'passwd2' => '确认密码',
			'merchant_email' => '商户邮件',
			'merchant_address' => '商户地址',
			'trade_amount' => '交易数量',
			'tarde_finance' => '交易金额',
			'merchant_name' => '商户名称',
			'merchant_phone' => '手机号码',
			'key_value' => '秘钥值',
			'merchant_country' => '商户所属国家',
			'merchant_addtime' => '商户注册时间',
			'merchant_ip' => '商户注册Ip地址',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		if(!empty($this->start_balance) || !empty($this->end_balance)){
			$start_val=floatval($this->start_balance);
			$end_val = floatval($this->end_balance);
			$criteria->addBetweenCondition('balance',$start_val,$end_val);
		}else {
			$criteria->compare('merchant_id',$this->merchant_id,true);
			$criteria->compare('balance',$this->balance,true);
			$criteria->compare('merchant_passwd',$this->merchant_passwd,true);
			$criteria->compare('commerce_no',$this->commerce_no,true);
			$criteria->compare('merchant_email',$this->merchant_email,true);
			$criteria->compare('merchant_address',$this->merchant_address,true);
			$criteria->compare('merchant_name',$this->merchant_name,true);
			$criteria->compare('merchant_phone',$this->merchant_phone,true);
			//$criteria->compare('key_value',$this->key_value,true);
			$criteria->compare('merchant_country',$this->merchant_country,true);
			$criteria->compare('merchant_addtime',$this->merchant_addtime,true);
			//$criteria->compare('merchant_ip',$this->merchant_ip,true);
		}
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>7,
				),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Merchant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getAddConfig(){
		return array(
				'title'=>'添加商户',
				'method'=>'post',
				'showErrorSummary'=>true,
				'showErrors'=>true,
				
				'activeForm'=>array(
						'class'=>'CActiveForm',
						'id'=>'merchant_add_form',
						),
				'elements'=>array(
						'merchant_name'=>array(
								'type'=>'text',	
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'merchant_passwd'=>array(
								'type'=>'password',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'passwd2'=>array(
								'type'=>'password',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'commerce_no'=>array(
								'type'=>'text',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'balance'=>array(
								'type'=>'text',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'merchant_email'=>array(
								'type'=>'email',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'merchant_phone'=>array(
								'type'=>'text',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),
						'merchant_country'=>array(
								'type'=>'text',
								'attributes'=>array('class'=>'tb_input_mer_right'),
								),	
						'merchant_address'=>array(
								'type'=>'textarea',
								'attributes'=>array('class'=>'tb_inarea'),
								),					
						),
				'buttons'=>array(
						'submit'=>array(
								'type'=>'submit',
								'label'=>'提交',
								'attributes'=>array('class'=>'but_confirm'),
								)
						)
				);
	}
}
