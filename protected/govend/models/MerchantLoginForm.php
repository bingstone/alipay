<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MerchantLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $verifyCode;
	private $_merchantIdentity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required','message'=>'用户名必填'),
			array('password', 'required','message'=>'密码必填'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
				
			array('verifyCode', 'captcha', 'on'=>'login', 'message'=>'请输入正确的验证码'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'商户名',
			'password'=>'密      码',
			'verifyCode'=>'验证码',
			'rememberMe'=>'记住登陆状态',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_merchantIdentity=new MerchantIdentity($this->username,$this->password);
			if(!$this->_merchantIdentity->authenticate())
				$this->addError('password','用户名或密码不存在');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_merchantIdentity===null)
		{
			$this->_merchantIdentity=new MerchantIdentity($this->username,$this->password);
			$this->_merchantIdentity->authenticate();
		}
		if($this->_merchantIdentity->errorCode===MerchantIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_merchantIdentity,$duration);
			return true;
		}
		else
			return false;
	}
}
