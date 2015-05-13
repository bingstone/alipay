<?php
/*****************************************************************************
 * 后台商品管理控制器
 * @charset UTF-8
 * @author wulin
 * @time 2014-9-12
 *****************************************************************************/
 
class ManagerController extends Controller{
  
  public $layout = '//layouts/column2';
	
  function filters(){
  	return array(
  			'accessControl',	
  		);
  }	
  
  function accessRules(){
  	return array(  		
  		array(
  				'allow',
  				'actions'=>array('addmerchant','deletemerchant','showmerchant','updatemerchant',
  						'adduser','deleteuser','showuser','updateuser','orderviewuser','orderviewmerchant','showadmin','addadmin','deleteadmin','updateadmin','orderviewadmin'),
  				'users'=>array('@'),
  			),
  		array(
  				'deny',
  				'users'=>array('*') 
  		),
   	);		  		
  }

  public function  actionShowUser(){  	
    $model=new User('search');
    $model->unsetAttributes();  // clear any default values
    if (Yii::app()->request->isPostRequest){
	    if(isset($_POST['start_balance']) || isset($_POST['end_balance']))
	    {    	
	    	$model->start_balance = $_POST['start_balance'];
	    	$model->end_balance = $_POST['end_balance'];
	    }
    }
    if(isset($_GET['User'])){    	
    	$model->attributes=$_GET['User'];
    }
    
    $this->render('showuser',array(
    		'model'=>$model,
    ));
  }
  
  public function  actionShowAdmin(){
  	$model=new Admin('search');
  	$model->unsetAttributes();  // clear any default values
  	if (Yii::app()->request->isPostRequest){
  		/*if(isset($_POST['start_balance']) || isset($_POST['end_balance']))
  		{
  			$model->start_balance = $_POST['start_balance'];
  			$model->end_balance = $_POST['end_balance'];
  		}*/
  	}
  	if(isset($_GET['Admin'])){
  		$model->attributes=$_GET['Admin'];
  	}
  
  	$this->render('showadmin',array(
  			'model'=>$model,
  	));
  }
  
  
  public function  actionDeleteUser($id){
   	$user_model = User::model();
   	$user_model = $user_model -> findByPk($id);
   	
   	if($user_model->delete())
   		$this -> redirect(ADMIN.'/manager/showuser');
  }
  
  
  public function  actionDeleteAdmin($id){
  	$user_model = Admin::model();
  	$user_model = $user_model -> findByPk($id);
  
  	if($user_model->delete())
  		$this -> redirect(ADMIN.'/manager/showadmin');
  }
  
  public function  actionAddUser(){
    
  	$user_model = new User();
  	if(isset($_POST['User']) && Yii::app()->request->isPostRequest){
  		/* foreach($_POST['User'] as $_k=> $_v){
  			$user_model -> $_k = $_v;
  		} */ 
  		
  		$_POST['User']['user_passwd'] = md5($_POST['User']['user_passwd']);
  		$_POST['User']['passwd2'] = md5($_POST['User']['passwd2']);
  		
  		$user_model -> attributes = $_POST['User'];
  		
  		$user_model -> user_lastlogin = date("Y-m-d H:i:s");
  		$user_model -> user_addtime = $user_model -> user_lastlogin;
  		$user_model -> user_lastip = Yii::app() -> request -> userHostAddress;
  		//dump($user_model);
  		if($user_model -> save()){
  			$this -> redirect(ADMIN.'manager/showuser');
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
  	$user_model->user_passwd = '';
  	$user_model->passwd2 = '';
    $this->render('adduser',array('user_model' => $user_model, 'sex' => $sex, 'type' => $type ));
  }
  
  
  public function  actionAddAdmin(){
  
  	$admin_model = new Admin();
  	if(isset($_POST['Admin']) && Yii::app()->request->isPostRequest){
  		/* foreach($_POST['User'] as $_k=> $_v){
  		 $user_model -> $_k = $_v;
  		} */
  
  		$_POST['Admin']['admin_passwd'] = md5($_POST['Admin']['admin_passwd']);
  		$_POST['Admin']['passwd2'] = md5($_POST['Admin']['passwd2']);
  
  		$admin_model -> attributes = $_POST['Admin'];
  
  		$admin_model -> admin_lastlogin = date("Y-m-d H:i:s");
  		$admin_model -> admin_addtime = $admin_model -> admin_lastlogin;
  		$admin_model -> admin_lastip = Yii::app() -> request -> userHostAddress;
  		//dump($user_model);
  		if($admin_model -> save()){
  			$this -> redirect(ADMIN.'manager/showadmin');
  		}
  	}
  	 
  	$admin_model->admin_passwd = '';
  	$admin_model->passwd2 = '';
  	$this->render('addadmin',array('admin_model' => $admin_model ));
  }
  
  public function  actionUpdateUser($id){
  	$user_model = User::model();
  	$user_info = $user_model -> findByPk($id);
  	if(isset($_POST['User'])){
  		/* foreach($_POST['User'] as $_k=> $_v){
  		 $user_info -> $_k = $_v;
  		} */
  	
  		$_POST['User']['user_passwd'] = md5($_POST['User']['user_passwd']);
  		$_POST['User']['passwd2'] = md5($_POST['User']['passwd2']);
  		
  		$user_info -> attributes = $_POST['User'];
  	
  		$user_info -> user_lastlogin = date("Y-m-d H:i:s");
  		$user_info -> user_addtime = $user_info -> user_lastlogin;
  		if($user_info -> save()){
  			$this -> redirect(ADMIN.'/manager/showuser');
  		}
  	}
  	 
  	$sex[1] = '男';
  	$sex[2] = '女';
  	$sex[3] = '保密';
  	 
  	$type[1] = '买家';
  	$type[2] = '卖家';
  	$user_info->user_passwd = '';
  	$user_info->passwd2 = '';
		
	$this->render ( 'updateuser', array (
				'user_info' => $user_info,
				'sex' => $sex,
				'type' => $type 
		) );
	
	}
	
	
	
	public function  actionUpdateAdmin($id){
		$admin_model = Admin::model();
		$admin_info = $admin_model -> findByPk($id);
		if(isset($_POST['Admin'])){
			/* foreach($_POST['User'] as $_k=> $_v){
			 $user_info -> $_k = $_v;
			} */

			$now_name = Yii::app()->user->getName();
			$now_id = Yii::app()->user->getId();
			$admin_name = $_POST['Admin']['admin_name'];
			
			//Yii::log('now_name='.$now_name.' now_id='.$now_id);
			if($now_name != $admin_name){
				$this->redirect(ADMIN.'admin/login');
			}
			
			
			$_POST['Admin']['admin_passwd'] = md5($_POST['Admin']['admin_passwd']);
			$_POST['Admin']['passwd2'] = md5($_POST['Admin']['passwd2']);
	
			$admin_info -> attributes = $_POST['Admin'];
			 
			$admin_info -> admin_lastlogin = date("Y-m-d H:i:s");
			$admininfo -> admin_addtime = $admin_info -> admin_lastlogin;
			if($admin_info -> save()){
				$this -> redirect(ADMIN.'/manager/showadmin');
			}
		}
	
		$admin_info->admin_passwd = '';
		$admin_info->passwd2 = '';
	
		$this->render ( 'updateadmin', array (
				'admin_info' => $admin_info,
		) );
	
	}
	
	
  public function actionOrderViewUser() {
	$order_infos = '';
	$temp_id;
	$cnt = 0;
	$per =8;
	$page;
	if(isset($_GET[start_date]) && isset($_GET[end_date])){
		$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
					->from ( '{{USER}} u' )
					->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( 'u.user_id= :id', array (':id' => $_GET[order_id]))
					->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>$_GET[end_date].' 00:00:00', ':low'=>$_GET[start_date].' 00:00:00'))
					->queryAll ();
		$cnt = count($order_infos);
		$temp_id = $_GET[order_id];
		$page = new Pagination($cnt, $per);
		$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
	}
	else{
		$temp_id = $_GET[id];
		switch ($_GET[type]){
			case 'all':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( 'u.user_id= :id', array (':id' => $_GET[id] ))							
							->queryAll ();
				$cnt = count($order_infos);				
				$page = new Pagination($cnt, $per);				
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'date_today':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('like','o.order_add_time', date('Y-m-d').'%')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'date_month_one':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('like','o.order_add_time', date('Y-m').'%')), array (':id' => $_GET[id]))
							->queryAll ();							
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'date_month_three':			
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( 'u.user_id= :id', array (':id' => $_GET[id]))
							->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>date('Y-m-d H:i:s'), ':low'=>date('Y-m-d H:i:s', strtotime("-3 Months"))))				
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'date_year_one':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('like','o.order_add_time', date('Y').'%')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'date_year_before':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('not like','o.order_add_time', date('Y').'%')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_processing':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('and','o.status_id <= 7', 'o.status_id >= 1')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_pay_no':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', 'o.status_id = 1'), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_waiting':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('and','o.status_id <= 5', 'o.status_id>= 4')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_receipt_no':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', array('and','o.status_id <= 7', 'o.status_id>= 6')), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_success':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', 'o.status_id = 9'), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			case 'trade_failure':
				$order_infos = Yii::app ()->db->createCommand ()
							->select ( 'm.merchant_name,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
							->from ( '{{USER}} u' )
							->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
							->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
							->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
							->where ( array('and', 'u.user_id= :id', 'o.status_id= 8'), array (':id' => $_GET[id]))
							->queryAll ();
				$cnt = count($order_infos);
				$page = new Pagination($cnt, $per);
				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
				break;
			default:
				echo 'check failure!!!';
				break;
		} 
	}
	if(!empty($page)){
		$page_list = $page->fpage();
	}
	else {
		$page_list = '';
	}
	  	
  	$this->render('orderviewuser',array('order_infos'=>$order_infos, 'order_id'=>$temp_id, 'page_list'=>$page_list));  	
  }
  
  public function  actionOrderViewMerchant(){
  	$order_infos = '';
  	$temp_id;
  	$cnt = 0;
  	$per =8;
  	$page;
  	if($_GET[start_date] && $_GET[end_date]){
  		$order_infos = Yii::app ()->db->createCommand ()
  		->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  		->from ( '{{MERCHANT}} m' )
  		->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  		->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  		->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  		->where ( 'm.merchant_id= :id', array (':id' => $_GET[order_id]))
  		->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>$_GET[end_date].' 24:24:00', ':low'=>$_GET[start_date].' 24:24:00'))
  		->queryAll ();
  		$cnt = count($order_infos);
  		$temp_id = $_GET[order_id];
  		$page = new Pagination($cnt, $per);
  		$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  	}
  	else{
  		$temp_id = $_GET[id];
  		switch ($_GET[type]){
  			case 'all':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( 'm.merchant_id= :id', array (':id' => $_GET[id] ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_today':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('like','o.order_add_time', date('Y-m-d').'%')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_month_one':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('like','o.order_add_time', date('Y-m').'%')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_month_three':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( 'm.merchant_id= :id', array (':id' => $_GET[id]))
  				->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>date('Y-m-d H:i:s'), ':low'=>date('Y-m-d H:i:s', strtotime("-3 Months"))))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_year_one':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('like','o.order_add_time', date('Y').'%')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_year_before':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('not like','o.order_add_time', date('Y').'%')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_processing':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('and','o.status_id <= 7', 'o.status_id >= 1')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_pay_no':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', 'o.status_id = 1'), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_waiting':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('and','o.status_id <= 5', 'o.status_id>= 4')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_receipt_no':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', array('and','o.status_id <= 7', 'o.status_id>= 6')), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_success':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', 'o.status_id = 9'), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_failure':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_id= :id', 'o.status_id= 8'), array (':id' => $_GET[id]))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			default:
  				echo 'check failure!!!';
  				break;
  		}
  	}
  	if(!empty($page)){
  		$page_list = $page->fpage();
  	}
  	else {
  		$page_list = '';
  	}  	
  	$this->render('orderviewmerchant',array('order_infos'=>$order_infos, 'order_id'=>$temp_id, 'page_list'=>$page_list));
  }
  
  public function  actionAddMerchant(){
  	$merchant_model = new Merchant();
  	//$merchant_form = new CForm($merchant_model->getAddConfig(),$merchant_model);
  	if(isset($_POST['Merchant']) && Yii::app()->request->isPostRequest){
  		$_POST['Merchant']['merchant_passwd'] = md5($_POST['Merchant']['merchant_passwd']);
  		$_POST['Merchant']['passwd2'] = md5($_POST['Merchant']['passwd2']);
  		
  		$merchant_model -> attributes = $_POST['Merchant'];
  		
  		$merchant_model -> merchant_addtime = date("Y-m-d H:i:s");  		
  		$merchant_model -> merchant_ip = Yii::app() -> request -> userHostAddress;
  		$merchant_model -> key_value = substr(md5($_POST['Merchant']['merchant_email']),0,32);
  		//dump($user_model);
  		if($merchant_model -> save()){
  			$this -> redirect(ADMIN.'manager/showmerchant');  			
  		}
  	}
  	$this->render('addmerchant',array(
  			'merchant_model'=>$merchant_model,
  			));
  }

  public function  actionUpdateMerchant($id){
  	$merchant_model = Merchant::model();
  	$merchant_info = $merchant_model -> findByPk($id);
  	if(isset($_POST['Merchant']) && Yii::app()->request->isPostRequest){
  		/* foreach($_POST['User'] as $_k=> $_v){
  		 $user_info -> $_k = $_v;
  		} */
  		 
  		$_POST['Merchant']['merchant_passwd'] = md5($_POST['Merchant']['merchant_passwd']);
  		$_POST['Merchant']['passwd2'] = md5($_POST['Merchant']['passwd2']);
  	
  		$merchant_info -> attributes = $_POST['Merchant'];
  		 
  		$merchant_info -> merchant_addtime = date("Y-m-d H:i:s");
  		$merchant_info -> merchant_ip = Yii::app() -> request -> userHostAddress;
  		if($merchant_info -> save()){
  			$this -> redirect(ADMIN.'/manager/showmerchant');
  		}
  	}
  	$merchant_info->merchant_passwd = '';
  	$merchant_info->passwd2 = '';
  	$this->render('updatemerchant',array('merchant_info' => $merchant_info,));
  }
  
  public function  actionShowMerchant(){
  	/* //创建模型对象
   	$merchant_model = Merchant::model();  
    //查询所有用户信息
    $merchant_infos = $merchant_model->findAll();
  	$criteria = new CDbCriteria();
  	if(trim($_GET[search_value])){
		//echo gettype($_GET[search_type]);
		$str_tmp = trim($_GET[search_value]);
		switch ($_GET[search_type]){
			case '1':				
				$val_tmp = intval($str_tmp,10);				
				$criteria->addCondition('merchant_id = :s_val');
				$criteria->params[':s_val']=$val_tmp;
				break;
			case '2':
				$str_tmp = strtr($str_tmp,array('%'=>'\%','_'=>'\_'));
				$criteria->addSearchCondition('merchant_name',$str_tmp);
				break;
			case '3':				
				$criteria->addSearchCondition('merchant_phone',$str_tmp);
				break;
			case '4':
				$str_tmp = strtr($str_tmp,array('%'=>'\%','_'=>'\_'));
				$criteria->addSearchCondition('merchant_email',$str_tmp);
				break;
			case '5':
				$str_tmp = strtr($str_tmp,array('%'=>'\%','_'=>'\_'));
				$criteria->addSearchCondition('merchant_country',$str_tmp);
				break;
		}
  	}  		
  	
  	if(trim($_GET[start_value] || trim($_GET[end_value]))){
  		if (trim($_GET[start_value] && trim($_GET[end_value]))){
  			$start_val=floatval(trim($_GET[start_value]));
  			$end_val = floatval(trim($_GET[end_value]));  			
  			$criteria->addBetweenCondition('balance',$start_val,$end_val);
  		}
  		elseif (trim($_GET[start_value])){
  			$start_val=floatval(trim($_GET[start_value]));
  			$criteria->addCondition('balance = :t_val');
  			$criteria->params[':t_val']=$start_val;
  		}
  		elseif (trim($_GET[end_value])){
  			$end_val = floatval(trim($_GET[end_value]));
  			$criteria->addCondition('balance = :t_val');
  			$criteria->params[':t_val']=$end_val;
  		}
  	}
  	
  	$dataProvider = new CActiveDataProvider('Merchant',array(
  		'criteria'=>$criteria,
  		'pagination'=>array(
			'pageSize'=>5
		),
  	));  	
    $this->render('showmerchant',array(
    		'dataProvider' => $dataProvider,));  */
    $model=new Merchant('search');
    $model->unsetAttributes();  // clear any default values
    if (Yii::app()->request->isPostRequest){
    	if(isset($_POST['start_balance']) || isset($_POST['end_balance']))
    	{
    		$model->start_balance = $_POST['start_balance'];
    		$model->end_balance = $_POST['end_balance'];
    	}
    }
    if(isset($_GET['Merchant'])){
    	$model->attributes=$_GET['Merchant'];
    }
    
    $this->render('showmerchant',array(
    		'model'=>$model,
    ));
  }
  
  public function actionDeleteMerchant($id){
  	$merchant_model = Merchant::model();
  	$merchant_model = $merchant_model -> findByPk($id);
  	
  	if($merchant_model->delete())
  		$this -> redirect(ADMIN.'/manager/showmerchant');
  }
  
  public function actionTest(){
  	$sessionpath = session_save_path();
  	if (strpos ($sessionpath, ";") !== FALSE)
  		$sessionpath = substr ($sessionpath, strpos ($sessionpath, ";")+1);
  	
  	//获取当前session的保存路径
  	echo $sessionpath;
  	
  	$this -> redirect(ADMIN.'/index/right');
  	
  	if(Yii::app()->user->getIsGuest()){
  		echo 'is guest';
  	} else {
  		echo 'is login';
  	}
  	echo '<br/>'.Yii::app()->session['admin__name'].'<br/>';
  	echo 'user session success <br/>';
  	
  	unset(Yii::app()->session['admin__name']);
  	
  	//Yii::app()->session->clear();
  	//Yii::app()->session->destroy();
  	$admin = Yii::app()->getRequest();
  	print_r($admin);
  	echo '<br/><br/>';
  	$user = Yii::app() ->getUser();
  	print_r($user);
  	$user;
  	echo '<br/>'.Yii::app()->user->getIsGuest().'<br/>';
  	echo Yii::app()->user->name.'<br/>';
  	echo Yii::app()->user->getStateKeyPrefix().'<br/><br/><br/>';
  	print_r(Yii::app()->getUser()); 
	echo '<br/><br/><br/>';
  	echo Yii::app()->user->id;
  	echo Yii::app()->user->isGuest;
  	//print_r($this->createAbsoluteUrl("orderview") );
  	/* if(yii::app()->request->getRequestType()=='GET'){
  		echo 'isget';
  	}
  	else {
  		echo 'noget';
  	}
  	print_r(Yii::app()->homeUrl ); */
  	//print_r(Yii::app()->controller->createUrl("oderview"));  	
  	$this->render('test');
  }
}

?>