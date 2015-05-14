<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class MerchantIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
  //身份验证，修改
  //private $_id;// +
	public function authenticate()
	{
		  $username=strtolower($this->username);
		  $merchant_info = Yii::app ()->db->createCommand ()
		  				->select ( 'merchant_email, merchant_passwd' )
		  				->from ( '{{MERCHANT}}' )
		  				->where ( 'merchant_email= :email', array (':email' => $username ))
		  				->queryrow ();
		  if(empty($merchant_info)){
		    $this->errorCode=self::ERROR_USERNAME_INVALID;
		  	return false;
		  } else if ($merchant_info[merchant_email] !== $this->username || $merchant_info[merchant_passwd] !== md5($this->password)){		 
		    $this->errorCode=self::ERROR_PASSWORD_INVALID;		  		    
		    return false;
		  } else {	  
		    $this->errorCode=self::ERROR_NONE;
		    return true;	    
		  }
		  return $this->errorCode==self::ERROR_NONE;
	}
	  
	  /** +
	   * @return integer the ID of the user record
	   */
	  /* public function getId()
	  {
	    return $this->_id;
	  } */
}