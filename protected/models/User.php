<?php

/**
 * This is the model class for table "{{USER}}".
 *
 * The followings are the available columns in table '{{USER}}':
 * @property string $user_id
 * @property string $user_name
 * @property string $user_passwd
 * @property string $user_phone
 * @property string $ali_email
 * @property integer $ali_type
 * @property string $ali_balance
 * @property string $ali_freeze
 * @property integer $user_sex
 * @property string $user_ico
 * @property string $user_birth
 * @property string $user_country
 * @property string $user_address
 * @property string $user_lastlogin
 * @property string $user_lastip
 * @property string $user_addtime
 */
class User extends CActiveRecord
{
	public $passwd2;
	public $start_balance;
	public $end_balance;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{USER}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name', 'required', 'message'=>'请输入用户名'),
			array('user_name', 'unique', 'message'=>'此用户已注册'),			
			array('user_passwd', 'required', 'message'=>'请输入密码'),
			array('user_birth', 'required', 'message'=>'请选择生日日期'),
			array('user_country', 'required', 'message'=>'请输入国家名称'),
			array('user_address', 'required', 'message'=>'请输入用户地址'),
			array('user_passwd', 'length', 'min'=>5, 'message'=>'请输入至少5位密码 '),
			array('passwd2', 'required', 'message'=>'请输入确认密码'),
			array('passwd2', 'length', 'min'=>5, 'message'=>'请输入至少5位确认密码 '),
			array('passwd2','compare','compareAttribute'=>'user_passwd','message'=>'两次密码不一致'),
			array('user_phone', 'required', 'message'=>'请输入手机号码'),
			//array('user_phone', 'match', 'pattern'=>'/^\+86\d{13}$/', 'message'=>'手机号码格式错误'),			
			array('ali_email', 'email', 'allowEmpty'=>false, 'message'=>'邮箱地址格式错误'),
			array('ali_email', 'unique', 'message'=>'此邮箱已注册'),
			array('ali_type, user_sex', 'numerical', 'integerOnly'=>true),					
			array('ali_balance', 'numerical', 'allowEmpty'=>false, 'message'=>'请输入数字'),
			//array('user_birth', 'date', 'allowEmpty'=>false,'format'=>'yyyy-MM-dd','message'=>'must be yyyy-mm-dd'),			
			array('user_country, user_address', 'length', 'max'=>255),
			array('ali_freeze, user_ico, user_lastlogin, trade_count, trade_money, user_addtime, user_lastip', 'safe'),
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
				'order'=>array(self::HAS_MANY, 'Order', 'buyer_id', ),
				'paypasswd'=>array(self::HAS_ONE, 'Paypasswd', 'user_id', ),
				'transferfromuser'=>array(self::HAS_MANY, 'TransferFromUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => '用户id',
			'user_name' => '账户名',
			'user_passwd' => '账户密码',
			'passwd2' => '确认密码',
			'user_phone' => '手机号码',
			'ali_email' => '用户邮箱',
			'ali_type' => '用户类型',
			'ali_balance' => '账户余额',
			'ali_freeze' => '冻结资金',
			'trade_count' => '交易量',
			'trade_money' => '交易额',
			'user_sex' => '性         别',
			'user_ico' => '图         标',
			'user_birth' => '出生年月',
			'user_country' => '国          家',
			'user_address' => '地          址',
			'user_lastlogin' => 'User Lastlogin',
			'user_lastip' => 'User Lastip',
			'user_addtime' => 'User Addtime',
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
			$criteria->addBetweenCondition('ali_balance',$start_val,$end_val);
		}else {
			$criteria->compare('user_id',$this->user_id,true);
			$criteria->compare('user_name',$this->user_name,true);
			//$criteria->compare('user_passwd',$this->user_passwd,true);
			$criteria->compare('user_phone',$this->user_phone,true);
			$criteria->compare('ali_email',$this->ali_email,true);
			$criteria->compare('ali_type',$this->ali_type);
			$criteria->compare('ali_balance',$this->ali_balance,true);
			$criteria->compare('ali_freeze',$this->ali_freeze,true);
			$criteria->compare('user_sex',$this->user_sex);
			//$criteria->compare('user_ico',$this->user_ico,true);
			$criteria->compare('user_birth',$this->user_birth,true);
			$criteria->compare('user_country',$this->user_country,true);
			$criteria->compare('user_address',$this->user_address,true);
			//$criteria->compare('user_lastlogin',$this->user_lastlogin,true);
			//$criteria->compare('user_lastip',$this->user_lastip,true);
			$criteria->compare('user_addtime',$this->user_addtime,true);
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>7,
			),
		));
	}

	public function allUserDataProvider(){
		$criteria=new CDbCriteria;
		//$criteria->with = 'parent';
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>5
				),
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
