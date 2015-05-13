<?php
/*****************************************************************************
 * 
 * @charset UTF-8
 * @author wulin
 * @time 2014-9-12
 *****************************************************************************/
 
class AdminController extends Controller
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
  	$admin_login = new AdminLoginForm;
  	if(!empty($_POST['AdminLoginForm']) && Yii::app()->request->isPostRequest ){  	
  		$admin_login->attributes = $_POST['AdminLoginForm'];
  		if($admin_login->validate() && $admin_login->login()){  		
  			$this->redirect(MANAGE.'index');
  		}  	
  	}
    $this->render('login', array('admin_login'=>$admin_login));
  }

  public function actionLogout()
  {
  	//Yii::app()->session->clear();
  	//Yii::app()->session->destroy();
  	Yii::app()->admin->logout(false);
  	$this->redirect(MANAGE.'admin/login');
  }
}
?>