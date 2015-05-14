<?php
/*****************************************************************************
 * 
 * @charset UTF-8
 * @author wulin
 * @time 2014-9-12
 *****************************************************************************/
 
class IndexController extends Controller
{
	
  public function actions(){
  	return array(
  			'captcha'=>array(
  					'class'=>'system.web.widgets.captcha.CCaptchaAction',
  					'minLength'=>4,
  					'maxLength'=>4,
  					),
  			);
  }
	
  public function actionLogin()
  {  	
  	$merchant_login = new MerchantLoginForm;
  	if(!empty($_POST['MerchantLoginForm']) && Yii::app()->request->isPostRequest ){  	
  		$merchant_login->attributes = $_POST['MerchantLoginForm'];
  		if($merchant_login->validate() && $merchant_login->login()){
  			$this->redirect(MERCHANT.'order/index');
  		}  	
  	}
    $this->render('login', array('merchant_login'=>$merchant_login));
  }

  public function actionLogout()
  {
  	//Yii::app()->session->clear();
  	//Yii::app()->session->destroy();
  	Yii::app()->user->logout();
  	$this->redirect(MERCHANT.'index/login');
  }
  
  public function actionerror()
  {
  	echo '此页面不存在!!';
  }
}
?>