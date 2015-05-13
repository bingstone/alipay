<?php
class IndexController extends Controller
{
	//public $layout = '//layouts/column2';
	
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
		$user_login = new UserLoginForm;
		if(!empty($_POST['UserLoginForm']) && Yii::app()->request->isPostRequest ){
			$user_login->attributes = $_POST['UserLoginForm'];
			if($user_login->validate() && $user_login->login()){
				$user_info = Yii::app()->db->createCommand()
				->select ('user_id,user_name, ali_email, ali_balance, ali_freeze,user_lastlogin')->from('{{USER}}')
				->where('user_name= :id', array(':id'=>$user_login->username))
				->queryRow();
				foreach($user_info as $_k=> $_v){
					Yii::app()->userinfo -> $_k = $_v;
				}
				$this->redirect(array('user/orderview','type'=>'all'));
			}
		}
		/*Yii::app()->controller->createUrl("orderviewuser",array("type"=>"userall","id"=>$data->user_id))*/
		$this->render('login', array('user_login'=>$user_login ));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout(true);
		Yii::app()->userinfo->clear();
		$this->redirect(MAIN.'index/login');
	}
	
	public function actionError()
	{
		$this->render('error');
	}
}
?>