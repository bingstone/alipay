<?php
class RegisterController extends Controller{
	
	public function actionUser(){
		$user_model = new User();
	  	if(isset($_POST['User']) && Yii::app()->request->isPostRequest){
	  		/* foreach($_POST['User'] as $_k=> $_v){
	  			$user_model -> $_k = $_v;
	  		} */ 
	  		
	  		$_POST['User']['user_passwd'] = md5($_POST['User']['user_passwd']);
	  		$_POST['User']['passwd2'] = md5($_POST['User']['passwd2']);
	  		
	  		$user_model -> attributes = $_POST['User'];
	  		
	  		$user_model -> ali_balance = 0.0;
	  		$user_model -> user_lastlogin = date("Y-m-d H:i:s");
	  		$user_model -> user_addtime = $user_model -> user_lastlogin;
	  		$user_model -> user_lastip = Yii::app() -> request -> userHostAddress;
	  		if($user_model -> save()){
	  			$this -> redirect(array('paypasswd', 'user_id'=>$user_model->user_id ));
	  		}
	  	}
	  	
	  	$sex[1] = '男';
	  	$sex[2] = '女';
	  	$sex[3] = '保密';
	  	
	  	$type[1] = '买家';
	  	$type[2] = '卖家';
	  	
	  	$user_model->user_phone=''; 
	  	$user_model->ali_type = 1;
	  	$user_model->user_sex = 3;
	  		  	
	    $this->render('user',array('user_model' => $user_model, 'sex' => $sex, 'type' => $type ));
	}
	
	public function actionPayPasswd(){		
		$model = new PayPasswdForm();
		$form = new CForm($model->getPayPasswdConfig(), $model);		
		if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
			$model->user_id=$_GET['user_id'];
		}
		if ($form->submitted() && $form->validate()){
			$paypasswd_model = new Paypasswd();
			$_POST['PayPasswdForm']['pay_passwd'] = md5($_POST['PayPasswdForm']['pay_passwd']);
			$paypasswd_model->attributes = $_POST['PayPasswdForm'];
			if($paypasswd_model->save()){
				$this->redirect(array('paypasswdresult','type'=>1));
			}
			else{
				$this->render('error');
			}
		}	
		$this->render('paypasswd', array('form'=>$form,));
	}
	
	public function actionPayPasswdResult(){
		if(isset($_GET['type']) && !empty($_GET['type'])){
			if($_GET['type'] == 1){
				Yii::app()->jump->success('注册，成功！', MAIN.'user/login');
			}			
			else{
				$this->render('error');
			}
		}
	}
	
	public function actionError()
	{
		$this->render('error');
	}
}
?>