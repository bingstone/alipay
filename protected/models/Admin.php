<?php

/**
 * This is the model class for table "{{ADMIN}}".
 *
 * The followings are the available columns in table '{{USER}}':
 * @property int(5)	$admin_id
 * @property string $admin_name
 * @property string $user_passwd
 * @property string $ali_email
 * @property integer $adminx_type
 * @property string $admin_count
 * @property string $admin_lastlogin
 * @property string $admin1_lastip
 * @property string $admin_addtime
 */
class Admin extends CActiveRecord
{
	public $passwd2;
	public $start_balance;
	public $end_balance;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ADMIN}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_name', 'required', 'message'=>'请输入用户名'),
			array('admin_name', 'unique', 'message'=>'此管理员已注册'),			
			array('admin_passwd', 'required', 'message'=>'请输入密码'),
			array('admin_passwd', 'length', 'min'=>5, 'message'=>'请输入至少5位密码 '),
			array('passwd2', 'required', 'message'=>'请输入确认密码'),
			array('passwd2', 'length', 'min'=>5, 'message'=>'请输入至少5位确认密码 '),
			array('passwd2','compare','compareAttribute'=>'admin_passwd','message'=>'两次密码不一致'),
			//array('user_phone', 'match', 'pattern'=>'/^\+86\d{13}$/', 'message'=>'手机号码格式错误'),			
			array('ali_email', 'email', 'allowEmpty'=>false, 'message'=>'邮箱地址格式错误'),
			array('ali_email', 'unique', 'message'=>'此邮箱已注册'),				
			//array('user_birth', 'date', 'allowEmpty'=>false,'format'=>'yyyy-MM-dd','message'=>'must be yyyy-mm-dd'),	
			//array('ali_freeze, user_ico, user_lastlogin, trade_count, trade_money, user_addtime, user_lastip', 'safe'),
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
				//'order'=>array(self::HAS_MANY, 'Order', 'buyer_id', ),
				//'paypasswd'=>array(self::HAS_ONE, 'Paypasswd', 'user_id', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_id' => '管理员id',
			'admin_name' => '管理员名',
			'admin_passwd' => '管理员密码',
			'passwd2' => '确认密码',
			'ali_email' => '管理员邮箱',
			'admin_lastlogin' => 'Admin Lastlogin',
			'admin_lastip' => 'Admin Lastip',
			'admin_addtime' => 'Admin Addtime',
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

		/*if(!empty($this->start_balance) || !empty($this->end_balance)){
			$start_val=floatval($this->start_balance);
			$end_val = floatval($this->end_balance);
			$criteria->addBetweenCondition('ali_balance',$start_val,$end_val);
		}else {*/
			$criteria->compare('admin_id',$this->admin_id,true);
			$criteria->compare('admin_name',$this->admin_name,true);
			//$criteria->compare('user_passwd',$this->user_passwd,true);
			$criteria->compare('ali_email',$this->ali_email,true);
			$criteria->compare('admin_addtime',$this->admin_addtime,true);
		//}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
					'pageSize'=>7,
			),
		));
	}

	public function allAdminDataProvider(){
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
