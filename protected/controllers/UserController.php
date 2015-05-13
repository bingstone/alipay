<?php

class UserController extends Controller
{	
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
					'accessControl',
			);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			 array('allow', // allow admin user to perform 'admin' and 'delete' actions
				/* 'actions'=>array('orderview', 'showorder', 'confirmpay', 'confirmreceipt',
						'payresult', 'recharge', 'receiptresult'), */
				'users'=>array('@'),
			), 
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionUserInfo(){
		$user_model = User::model();
		$user_info = $user_model->findByPk(Yii::app()->userinfo->user_id);
		$order_model = Order::model();
		$order_count = $order_model->count('buyer_id = :id',array(':id' => Yii::app()->userinfo->user_id));
		$order_succes = $order_model->count('buyer_id = :id and status_id = 9',array(':id' => Yii::app()->userinfo->user_id));
		$order_pross = $order_count - $order_succes;
		$this->render('userinfo', array('user_info'=>$user_info, 'order_count'=>$order_count, 'order_succes'=>$order_succes, 'order_pross'=>$order_pross));	
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionOrderView(){
		$order_infos = '';			
		$cnt = 0;
		$per =8;
		$page;
		if($_GET[start_date] && $_GET[end_date]){
			$order_infos = Yii::app ()->db->createCommand ()
			->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )
			->from ( '{{USER}} u' )
			->join ( '{{ORDER}} o', 'o.buyer_email=u.ali_email' )
			->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
			->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
			->where ( 'u.user_id= :id', array (':id' => Yii::app()->userinfo->user_id))
			->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>$_GET[end_date].' 00:00:00', ':low'=>$_GET[start_date].' 00:00:00'))
			->order ('o.order_add_time desc')
			->queryAll ();
			$cnt = count($order_infos);			
			$page = new Pagination($cnt, $per);
			$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
		}
		else {			
			switch ($_GET[type]){
				case 'all':					
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )				
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( 'o.buyer_id = :id', array (':id' => Yii::app()->userinfo->user_id ))
					->order ('o.order_add_time desc')
					->queryAll ();					
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'date_today':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('like','o.order_add_time', date('Y-m-d').'%')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'date_month_one':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('like','o.order_add_time', date('Y-m').'%')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'date_month_three':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( 'o.buyer_id= :id', array (':id' => Yii::app()->userinfo->user_id))
					->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>date('Y-m-d H:i:s'), ':low'=>date('Y-m-d H:i:s', strtotime("-3 Months"))))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'date_year_one':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('like','o.order_add_time', date('Y').'%')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'date_year_before':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('not like','o.order_add_time', date('Y').'%')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_processing':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('and','o.status_id <= 7', 'o.status_id >= 1')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_pay_no':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', 'o.status_id = 1'), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_waiting':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('and','o.status_id <= 5', 'o.status_id>= 4')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_receipt_no':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', array('and','o.status_id <= 7', 'o.status_id>= 6')), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_success':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )
					->from ( '{{ORDER}} o' )					
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', 'o.status_id = 9'), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
					->queryAll ();
					$cnt = count($order_infos);
					$page = new Pagination($cnt, $per);
					$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
					break;
				case 'trade_failure':
					$order_infos = Yii::app ()->db->createCommand ()
					->select ( 'm.merchant_name,o.ali_order_id,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id,o.order_add_time' )					
					->from ( '{{ORDER}} o' )
					->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
					->join ( '{{MERCHANT}} m', 'm.merchant_email=o.seller_email' )
					->where ( array('and', 'o.buyer_id= :id', 'o.status_id= 8'), array (':id' => Yii::app()->userinfo->user_id))
					->order ('o.order_add_time desc')
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
		$this->render('orderview',array('order_infos'=>$order_infos, 'page_list'=>$page_list));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionConfirmPay()
	{		
		$model = new PayValidateForm();
		$form = new CForm($model->getPayConfig(), $model);
		$model->user_id = Yii::app()->userinfo->user_id;
		if (isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$criteria = new CDbCriteria();
			$criteria->with=array(
					'merchant'=>array('select'=>'merchant_name, merchant_email, merchant_phone'),
					'orderstatus'=>array('select'=>'status_info'),
					'paytype'=>array('select'=>'pay_type_info'),
					'tradetype'=>array('select'=>'trade_type_info'),
			);
			$criteria->addCondition('t.ali_order_id = :id');
			$criteria->params[':id']= $_GET['order_id'];
			$criteria->select=array('t.ali_order_id', 't.out_trade_no', 't.buyer_id', 't.status_id',
					't.price', 't.quantity', 't.logistics_payment', 't.logistics_type',
					't.logistics_fee', 't.subject', 't.body', 't.show_url', 't.receive_name',
					't.receive_zip', 't.receive_address','t.receive_phone', 't.receive_mobile',
					't.order_add_time',);
			$order_info = Order::model()->find($criteria);
		}
		if ($order_info->status_id == 4) {
			$this->redirect(array('user/orderview','type'=>'all'));
		}
		if(!empty($order_info)){
			//$form->user_id = Yii::app()->userinfo->user_id;
			if ($form->submitted() && $form->validate()){				
				$total = $order_info->price * $order_info->quantity;
				if(Yii::app()->userinfo->ali_balance >= $total){
					$user_model = User::model();
					$transaction = $user_model->dbConnection->beginTransaction();
					try {
						$user_info = $user_model->findByPk(Yii::app()->userinfo->user_id);
						$user_info->ali_balance -= $total;
						$user_info->ali_freeze += $total; 
						$user_info->update();
						Yii::app()->userinfo->ali_balance = $user_info->ali_balance;
						Yii::app()->userinfo->ali_freeze = $user_info->ali_freeze;
						$order_info->updateByPk($_GET['order_id'], array('status_id'=>4, 'order_pay_time'=>date('Y-m-d H:i:s'), ));
						$transaction->commit();
					}catch(Exception $e){
						$transaction->rollBack();
						$this->redirect(array('payresult','type'=>3));
					}
					$this->redirect(array('payresult','type'=>1, 'id'=>$order_info->ali_order_id, 'action'=>PAY,));
				}
				else{
					$this->redirect(array('payresult','type'=>2));
				}
			}
			$this->render('confirmpay', array('order_info'=>$order_info, 'form'=>$form,));
		}
		else {
			$this->render('error');
		}						
	}
	
	public function actionPayResult(){
		if(isset($_GET['type']) && !empty($_GET['type'])){ 			
			if($_GET['type'] == 1){
				Yii::app()->jump->success('付款，成功！', MAIN.'response/return/id/'.$_GET['id'].'/action/'.$_GET['action']);
			}
			else if($_GET['type'] == 2){
				Yii::app()->jump->error('付款，失败！余额不足，请充值。', MAIN.'user/recharge');
			}
			else if($_GET['type'] == 3){
				Yii::app()->jump->error('付款，失败！原因未知。', MAIN.'user/error');
			}
			else{
				$this->render('error');
			}		
		}
	}
	
	public function actionReceiptResult(){
		if(isset($_GET['type']) && !empty($_GET['type'])){
			if($_GET['type'] == 1){
				Yii::app()->jump->success('收货，成功！', MAIN.'response/return/id/'.$_GET['id'].'/action/'.$_GET['action']);
				//Yii::app()->jump->success('收货，成功！', MAIN.'user/orderview/type/all');
			}
			else if($_GET['type'] == 2){
				Yii::app()->jump->error('收货，失败！余额不足，请充值。', MAIN.'user/recharge');
			}
			else if($_GET['type'] == 3){
				Yii::app()->jump->error('收货，失败！原因未知。', MAIN.'user/error');
			}
			else{
				$this->render('error');
			}
		}
	}
	
	public function actionRecharge(){
		$user_model = User::model();
		$user_info = $user_model->findByPk(Yii::app()->userinfo->user_id);
		$user_recharge=User::model();
		if(isset($_POST['User']) && isset($user_info->user_name))
		{
			if($_POST['User']['ali_balance']>=0 && is_numeric($_POST['User']['ali_balance']))
			{
					$ru=new RechargeUser();
					$user_info->ali_balance+=$_POST['User']['ali_balance'];
					User::model()->updatebypk(Yii::app()->userinfo->user_id,array('ali_balance'=>$user_info->ali_balance));
					$ru->user_id=$user_info->user_id;
					$ru->recharge=$_POST['User']['ali_balance'];
					$ru->date=date("Y-m-d H:i:m");
					$ru->ip=Yii::app()->request->userHostAddress;
					$ru->save();
					Yii::app()->jump->success('充值成功！', MAIN.'user/recharge');
					//$this->render('rechargesuccess',array('ali_balance'=>$_POST['User']['ali_balance']));
			}
			else
				Yii::app()->jump->error('充值失败！', MAIN.'user/recharge');
				//$this->render('rechargefalse');
		}
		else
			$this->render('recharge',array('user_recharge'=>$user_recharge));
	}
	
	public function actionRechargeUser()
	{
		$model=new RechargeUser('search');
		$model->unsetAttributes();  // clear any default values
		$model->user_id=Yii::app()->userinfo->user_id;
		if(isset($_GET['RechargeUser'])){
			$model->attributes=$_GET['RechargeUser'];
		}
		$this->render('rechargeuser',array('model'=>$model));
	}
	
	public function actiontransferToUser()
	{
		if(isset($_POST['passwd']))
		{
			$user_pass=Paypasswd::model();
			$userp=$user_pass->findbyattributes(array('user_id'=>Yii::app()->userinfo->user_id));
			$user_model=User::model();
			$transfer=$user_model->findbypk($_POST[transfer_id]);
			if($userp->pay_passwd==md5($_POST['passwd']))
			{
// 							$user->ali_balance-=$_POST['price'];
// 							$transfer->ali_balance+=$_POST['price'];
// 							$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
// 							$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
// 							Yii::app()->jump->success('转账成功！', MAIN.'user/transfertouser');
				//echo $_POST[price]."! ".$_POST[transfer_id]."@ ".Yii::app()->userinfo->user_id;
				$pay=$user_model->findbypk(Yii::app()->userinfo->user_id);
				$pay->ali_balance-=$_POST[price];
				$transfer->ali_balance+=$_POST[price];
				//echo $pay->ali_balance." ".$transfer->ali_balance;
				$pay->updatebypk($pay->user_id,array('ali_balance'=>$pay->ali_balance));
 				$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
 				
 				$tm=new TransferFromUser();
 				$tm->user_id=Yii::app()->userinfo->user_id;
 				$tm->transfertoid=$transfer->user_id;
 				$tm->transfertoemail=$transfer->ali_email;
 				$tm->transfertoname=$transfer->user_name;
 				$tm->price=$_POST[price];
 				$tm->date=date("Y:m:d H:i:m");
 				$tm->ip=Yii::app()->request->userHostAddress;
 				$tm->type=1;
 				$tm->save();
 				
 				$model=new TransferFromUser('search');
 				$model->unsetAttributes();  // clear any default values
 				$model->user_id=$pay->user_id;
 					
 				Yii::app()->jump->success('转账成功！', MAIN.'user/transferrecord',array('model'=>$model));
			}
			else 
			{
				$error="转账密码错误";
				$this->render('transfer2',array('type'=>1,'transfer'=>$transfer,'price'=>$_POST[price],'error'=>$error));
				//Yii::app()->jump->error('您的账户金额不足，无法转账。', MAIN.'user/transfertouser');
			}
			
		}
		elseif(isset($_POST['transfer']) || isset($_POST['transfer2']) || isset($_POST['price']))
		{
			
			if($_POST['transfer']!=$_POST['transfer2'])
			{
				Yii::app()->jump->error('两次输入的账号不一致', MAIN.'user/transfertouser');
			}
			elseif(!is_numeric($_POST['price']) || $_POST['price']<0)
			{
				Yii::app()->jump->error('请输入正确的金额', MAIN.'user/transfertouser');
			}
			
			$user_model=User::model();
			$user=$user_model->findbypk(Yii::app()->userinfo->user_id);
			if($user->ali_balance<$_POST['price'])
				Yii::app()->jump->error('您的账户金额不足，无法转账。', MAIN.'user/transfertouser');
			
			$transfer=$user_model->findbyattributes(array('user_name'=>$_POST['transfer']));
			if(!$transfer)
			{
				$transfer=$user_model->findbyattributes(array('ali_email'=>$_POST['transfer']));
				if(!$transfer)
				{
					Yii::app()->jump->error('您输入的账号不存在。', MAIN.'user/transfertouser');
				}
			}
// 			$user->ali_balance-=$_POST['price'];
// 			$transfer->ali_balance+=$_POST['price'];
// 			$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
// 			$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
// 			Yii::app()->jump->success('转账成功！', MAIN.'user/transfertouser');
		
			$this->render('transfer2',array('type'=>1,'transfer'=>$transfer,'price'=>$_POST[price]));
			//$this->redirect(array('user/transfer2'));
		}
		else 
			$this->render('transfer',array('type'=>1));
	}
	
	public function actiontransferToMerchant()
	{
		if(isset($_POST['passwd']))
		{
			$user_pass=Paypasswd::model();
			$userp=$user_pass->findbyattributes(array('user_id'=>Yii::app()->userinfo->user_id));
			$user_model=User::model();
			$merchant_model=Merchant::model();
			$transfer=$merchant_model->findbypk($_POST[transfer_id]);
			if($userp->pay_passwd==md5($_POST['passwd']))
			{
// 							$user->ali_balance-=$_POST['price'];
// 							$transfer->ali_balance+=$_POST['price'];
// 							$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
// 							$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
// 							Yii::app()->jump->success('转账成功！', MAIN.'user/transfertouser');
				//echo $_POST[price]."! ".$_POST[transfer_id]."@ ".Yii::app()->userinfo->user_id;
				
				$pay=$user_model->findbypk(Yii::app()->userinfo->user_id);
				$pay->ali_balance-=$_POST[price];
				$transfer->balance+=$_POST[price];
				//echo $pay->ali_balance." ".$transfer->ali_balance;
				$pay->updatebypk($pay->user_id,array('ali_balance'=>$pay->ali_balance));
 				$transfer->updatebypk($transfer->merchant_id,array('balance'=>$transfer->balance));
 				
 				$tm=new TransferFromUser();
 				$tm->user_id=Yii::app()->userinfo->user_id;
 				$tm->transfertoid=$transfer->merchant_id;
 				$tm->transfertoemail=$transfer->merchant_email;
 				$tm->transfertoname=$transfer->merchant_name;
 				$tm->price=$_POST[price];
 				$tm->date=date("Y:m:d H:i:m");
 				$tm->ip=Yii::app()->request->userHostAddress;
 				$tm->type=2;
 				$tm->save();
 				
 				$model=new TransferFromUser('search');
 				$model->unsetAttributes();  // clear any default values
 				$model->user_id=$pay->user_id;
 				
 				Yii::app()->jump->success('转账成功！', MAIN.'user/transferrecord',array('model'=>$model));
			
			}
			else 
			{
				$error="转账密码错误";
				$this->render('transfer2',array('type'=>2,'transfer'=>$transfer,'price'=>$_POST[price],'error'=>$error));
				//Yii::app()->jump->error('您的账户金额不足，无法转账。', MAIN.'user/transfertouser');
			}
			
		}
		elseif(isset($_POST['transfer']) || isset($_POST['transfer2']) || isset($_POST['price']))
		{
			
			if($_POST['transfer']!=$_POST['transfer2'])
			{
				Yii::app()->jump->error('两次输入的账号不一致', MAIN.'user/transfertouser');
			}
			elseif(!is_numeric($_POST['price']) || $_POST['price']<0)
			{
				Yii::app()->jump->error('请输入正确的金额', MAIN.'user/transfertouser');
			}
			
			$user_model=User::model();
			$user=$user_model->findbypk(Yii::app()->userinfo->user_id);
			if($user->ali_balance<$_POST['price'])
				Yii::app()->jump->error('您的账户金额不足，无法转账。', MAIN.'user/transfertouser');
			$merchant_model=Merchant::model();
			$transfer=$merchant_model->findbyattributes(array('merchant_name'=>$_POST['transfer']));
			if(!$transfer)
			{
				$transfer=$merchant_model->findbyattributes(array('merchant_email'=>$_POST['transfer']));
				if(!$transfer)
				{
					Yii::app()->jump->error('您输入的账号不存在。', MAIN.'user/transfertouser');
				}
			}
// 			$user->ali_balance-=$_POST['price'];
// 			$transfer->ali_balance+=$_POST['price'];
// 			$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
// 			$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
// 			Yii::app()->jump->success('转账成功！', MAIN.'user/transfertouser');
		
			$this->render('transfer2',array('type'=>2,'transfer'=>$transfer,'price'=>$_POST[price]));
			//$this->redirect(array('user/transfer2'));
		}
		else 
			$this->render('transfer',array('type'=>2));
	}
	
	public function actionTransferRecord()
	{
		$user_model=User::model();
		$user=$user_model->findbypk(Yii::app()->userinfo->user_id);
		$model=new TransferFromUser('search');
		$model->unsetAttributes();  // clear any default values
		$model->user_id=$user->user_id;
		
		$this->render('transferrecord',array('model'=>$model));
	}
	
	public function actionPayOrder(){		
		if (isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$criteria = new CDbCriteria();
			$criteria->with=array(
					'merchant'=>array('select'=>'merchant_name, merchant_email, merchant_phone'),
					'orderstatus'=>array('select'=>'status_info'),
					'paytype'=>array('select'=>'pay_type_info'),
					'tradetype'=>array('select'=>'trade_type_info'),
			);
			$criteria->addCondition('t.ali_order_id = :id');
			$criteria->params[':id']= $_GET['order_id'];
			$criteria->select=array('t.ali_order_id', 't.out_trade_no','t.buyer_id',
					't.price', 't.quantity', 't.logistics_payment', 't.logistics_type',
					't.logistics_fee', 't.subject', 't.body', 't.show_url', 't.receive_name',
					't.receive_zip', 't.receive_address','t.receive_phone', 't.receive_mobile',
					't.order_add_time',);
			$order_info = Order::model()->find($criteria);
			if(!empty($order_info)){
				$model = new PayValidateForm();
				$form = new CForm($model->getPayConfig(), $model);
				if ($form->submitted() && $form->validate()){
					WebMessage::success('付款，成功！<br/>2秒钟后返回',MAIN.'user/orderview/type/all/id',2);					
				}
				$this->render('payorder', array('order_info'=>$order_info, 'form'=>$form,));				
			}
		} 
		else {
			$this->render('error');
		}
	}
	
	public function actionShowOrder(){
		if (isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$criteria = new CDbCriteria();			
			$criteria->with=array(
						'merchant'=>array('select'=>'merchant_name, merchant_email, merchant_phone'),
						'orderstatus'=>array('select'=>'status_info'),
						'paytype'=>array('select'=>'pay_type_info'),
						'tradetype'=>array('select'=>'trade_type_info'),
					);
			$criteria->addCondition('t.ali_order_id = :id');
			$criteria->params[':id']= $_GET['order_id'];
			$criteria->select=array('t.ali_order_id', 't.out_trade_no',
					't.price', 't.quantity', 't.logistics_payment', 't.logistics_type',
					't.logistics_fee', 't.subject', 't.body', 't.show_url', 't.receive_name',
					't.receive_zip', 't.receive_address','t.receive_phone', 't.receive_mobile',
					't.order_add_time',);
			$order_info = Order::model()->find($criteria);			
			if(!empty($order_info)){
				$this -> render('showorder',array('order_info'=>$order_info));				
			}
		}
		else {
			$this->render('error');
		}
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionError()
	{
		
		$this->render('error');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionConfirmReceipt()
	{
		$model = new PayValidateForm();
		$form = new CForm($model->getReceiptConfig(), $model);
		$model->user_id = Yii::app()->userinfo->user_id;
		if (isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$criteria = new CDbCriteria();
			$criteria->with=array(
					'merchant'=>array('select'=>'balance, trade_amount, tarde_finance'),				
					'user'=>array('select'=>'ali_freeze'),					
			);
			$criteria->addCondition('t.ali_order_id = :id');
			$criteria->params[':id']= $_GET['order_id'];
			$criteria->select=array('t.price', 't.quantity', 
					't.logistics_fee', 't.status_id', 't.order_receive_time',);
			$order_info = Order::model()->find($criteria);			
		}
		if ($order_info->status_id == 9) {
			$this->redirect(array('user/orderview','type'=>'all'));
		}
		if(!empty($order_info)){
			if ($form->submitted() && $form->validate()){
				$total = $order_info->price * $order_info->quantity;
				if(Yii::app()->userinfo->ali_freeze >= $total){
					$user_model = User::model();
					$transaction = $user_model->dbConnection->beginTransaction();
					try {						
						$user_info = $user_model->findByPk(Yii::app()->userinfo->user_id);						
						$user_info->ali_freeze -= $total;
						$user_info->trade_count++;
						$user_info->trade_money += $total;			
						$user_info->update();						
						Yii::app()->userinfo->ali_freeze = $user_info->ali_freeze;						
						$order_info->merchant->balance += $total;
						$order_info->merchant->trade_amount++;
						$order_info->merchant->tarde_finance += $total;
						$order_info->status_id = 9;	
						$order_info->order_receive_time = date('Y-m-d H:i:s');					
						$order_info->update();
						$order_info->merchant->update();						
						$transaction->commit();
					}catch(Exception $e){  
						$transaction->rollBack();
						$this->redirect(array('receiptresult','type'=>3));
					}
					$this->redirect(array('receiptresult','type'=>1, 'id'=>$order_info->ali_order_id, 'action'=>RECEIVE,));
					//$this->redirect(array('receiptresult','type'=>1));
				}
				else{
					$this->redirect(array('receiptresult','type'=>2));
				}
			}
		}	
		$this->render('confirmreceipt', array('form'=>$form));
	}
	

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function actionTest()
	{
				$tm=new TransferFromMerchant();
 				$tm->merchant_id=11;
 				$tm->transfertoid=11;
 				$tm->price=$_POST[price];
 				$tm->date=date("Y:m:d H:i:m");
 				$tm->ip=Yii::app()->request->userHostAddress;
 				$tm->type=2;
 				$tm->save();
// 		$user_model = User::model()->findByPk(200818);	
// 		print_r($user_model);
// 		$user_model->ali_balance -= 1000;
// 		$user_model->ali_freeze += 1000;
// 		echo '<br/>';
// 		echo $user_model->ali_balance;
// 		echo '<br/>';
// 		echo $user_model->ali_freeze;
// 		$user_model->save();
		//echo 'success';
		//print_r($pay_model->user_id);
		//echo date('Y-m-d');
		/*$order_model = new Order();
		$order_info = $order_model->findByPk(6007032117);
		print_r($order_info);
		echo '<br/>';
		$order_info ->ali_order_id = 6007032118;
		$order_info ->buyer_id =NULL;
		if ($order_info->save())
			echo "successs";
		else 
			echo 'filaeddd';*/
		//$order_info=Order::model()->with('user')->findByPk(600702);
		//$user_info = User::model()->findByPk(200818);
		//dump($order_info->user, false);
		//var_dump($order_info);
		//$merchant_info = Order::model()->findByPk(600702);
		//print_r($merchant_info->merchant);
		//$merchant_info = Merchant::model()->findByPk(12345678991124);
		//print_r($merchant_info->order);
		//echo '<br/>';
		//print_r($order_info->user);
		//echo '<br/>';
		//$user = $order_info->user;
		//print_r($user_info->order);
		
		
		//$order_f = Order::model()->findByPK(600702);
		//echo '<br/>';
		//var_dump($order_f);
		//$user = $order_f->user;
		//print_r($user);
		//echo 'test order_info <br/>';
		//$user_info = User::model()->findByPk(200818);
		//var_dump($user_info);
		/* if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; */
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
