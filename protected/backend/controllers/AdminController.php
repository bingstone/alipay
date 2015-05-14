<?php
/*****************************************************************************
 * 
 * @charset UTF-8
 * @author wulin
 * @time 2014-9-12
 *****************************************************************************/
 
class AdminController extends Controller
{
	public $layout = '//layouts/column2';
	public $menu=array(
			array('label'=>'List Job', 'url'=>array('index')),
			array('label'=>'Create Job', 'url'=>array('create')),
		);
	
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
  		$_POST['AdminLoginForm']['password'] = md5($_POST['AdminLoginForm']['password']);
  		$admin_login->attributes = $_POST['AdminLoginForm'];
  		if($admin_login->validate() && $admin_login->login()){
  			echo "success";  		
  			$this->redirect(ADMIN.'index');
  		}  	
  	}
    $this->render('login', array('admin_login'=>$admin_login));
  }

  public function actionLogout()
  {
  	//Yii::app()->session->clear();
  	//Yii::app()->session->destroy();
  	Yii::app()->user->logout();
  	$this->redirect(ADMIN.'admin/login');
  }
  
  public function actionerror()
  {
  	echo '此页面不存在!!';
  }
}
?>