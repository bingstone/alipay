<?php
class OrderController extends Controller
{
	
	public $layout = '//layouts/column2';
	
	public function actionIndex()
	{
		if(!empty(Yii::app()->user->name)){    		
    		$merchant_info = Yii::app ()->db->createCommand ()
    		->select ( '*' )
    		->from ( '{{MERCHANT}}' )
    		->where ( 'merchant_email= :email', array (':email' => Yii::app()->user->name))
    		->queryrow ();
    		//Yii::app()->merchantinfo->merchant_email = $merchant_info->merchant_email;
    	}    
        $this ->render('index', array('merchant_info'=>$merchant_info,));
	}
	
	public function actionTest()
	{
		$status_info = Yii::app()->db->createCommand ()
		->select('status_id')
		->from('{{ORDER}}')
		->where('ali_order_id = 20150119011299692')
		->queryRow();
		print_r($status_info);
		echo $status_info['status_id'];
		/* if ($status_info['status_id']){
			$this->redirect(array('order/orderview','type'=>'all'));
		}	 */	
	}
	
	public function actionOrderView()
	{
		$order_infos = '';  	
  	$cnt = 0;
  	$per =8;
  	$page;
  	if(isset($_GET['start_date']) && isset($_GET['end_date'])){
  		$order_infos = Yii::app ()->db->createCommand ()
  		->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  		->from ( '{{MERCHANT}} m' )
  		->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  		->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  		->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  		->where ( 'm.merchant_email= :email', array (':email' => Yii::app()->user->getName() ))
  		->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>$_GET[end_date].' 24:24:00', ':low'=>$_GET[start_date].' 24:24:00'))
  		->queryAll ();
  		$cnt = count($order_infos);  		
  		$page = new Pagination($cnt, $per);
  		$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  	}
  	else{  		
  		switch ($_GET[type]){
  			case 'all':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( 'm.merchant_email= :email', array (':email' => Yii::app()->user->getName() ))
  				->order('o.order_add_time desc')
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_today':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('like','o.order_add_time', date('Y-m-d').'%')), array (':email' => Yii::app()->user->getName()))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_month_one':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('like','o.order_add_time', date('Y-m').'%')), array (':email' => Yii::app()->user->getName()))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_month_three':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( 'm.merchant_email= :email', array (':email' => Yii::app()->user->getName() ))
  				->andWhere( array('and','o.order_add_time < :high', 'o.order_add_time > :low'), array( ':high'=>date('Y-m-d H:i:s'), ':low'=>date('Y-m-d H:i:s', strtotime("-3 Months"))))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_year_one':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email = :email', array('like','o.order_add_time', date('Y').'%')), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'date_year_before':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('not like','o.order_add_time', date('Y').'%')), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_processing':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('and','o.status_id <= 7', 'o.status_id >= 1')), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_pay_no':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', 'o.status_id = 1'), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_waiting':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('and','o.status_id <= 5', 'o.status_id>= 4')), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_receipt_no':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', array('and','o.status_id <= 7', 'o.status_id>= 6')), array (':email' => Yii::app()->user->getName() ))
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_success':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', 'o.status_id = 9'), array (':email' => Yii::app()->user->getName() ))  				
  				->queryAll ();
  				$cnt = count($order_infos);
  				$page = new Pagination($cnt, $per);
  				$order_infos = array_slice($order_infos, $page->getOffset(), $page->getLimit());
  				break;
  			case 'trade_failure':
  				$order_infos = Yii::app ()->db->createCommand ()
  				->select ( 'u.user_name,o.ali_order_id,o.buyer_email,o.price,o.out_trade_no,o.subject,o.order_add_time,s.status_info,o.status_id' )
  				->from ( '{{MERCHANT}} m' )
  				->join ( '{{ORDER}} o', 'o.seller_email=m.merchant_email' )
  				->join ( '{{ORDER_STATUS}} s', 's.status_id=o.status_id' )
  				->join ( '{{USER}} u', 'u.ali_email=o.buyer_email' )
  				->where ( array('and', 'm.merchant_email= :email', 'o.status_id= 8'), array (':email' => Yii::app()->user->getName() ))
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
	
	public function actionSendGoods()
	{
		if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
			$criteria = new CDbCriteria();
			$criteria->with=array(					
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
				$this -> render('sendgoods',array('order_info'=>$order_info));
			} else {
				$this->render('error');
			}
		} else if (isset($_POST['logisticsno']) && Yii::app()->request->isPostRequest) {			
			if (empty($_POST['logisticsno'])) {
				$criteria = new CDbCriteria();
				$criteria->with=array(
						'orderstatus'=>array('select'=>'status_info'),
						'paytype'=>array('select'=>'pay_type_info'),
						'tradetype'=>array('select'=>'trade_type_info'),
				);
				$criteria->addCondition('t.ali_order_id = :id');
				$criteria->params[':id']= $_POST['order_id'];
				$criteria->select=array('t.ali_order_id', 't.out_trade_no',
						't.price', 't.quantity', 't.logistics_payment', 't.logistics_type',
						't.logistics_fee', 't.subject', 't.body', 't.show_url', 't.receive_name',
						't.receive_zip', 't.receive_address','t.receive_phone', 't.receive_mobile',
						't.order_add_time',);
				$order_info = Order::model()->find($criteria);
				if(!empty($order_info)){
					$this -> render('sendgoods',array('order_info'=>$order_info, 'error_info'=>'物流号不能为空！！！'));
				} else {
					$this->redirect('error');
				}
			} else {
				$order_model = Order::model();
				$transaction = $order_model->dbConnection->beginTransaction();
				try {
					$order_model->updateByPk($_POST['order_id'], array('status_id'=>6, 'logistics_no'=>$_POST['logisticsno'], 'order_send_time'=>date('Y-m-d H:i:s'), ));
				}catch(Exception $e){
					$transaction->rollBack();
					$this->redirect(array('sendresult','type'=>3));
				}
				$this->redirect(array('sendresult','type'=>1, 'id'=>$_POST['order_id'], 'action'=>SEND_S,));
				//$this->redirect(array('sendresult','type'=>1 ));
			}
		} else {
			$this->redirect('error');
		}
	}
	
	public function actionSendResult(){
		if($_GET['type'] == 1){
				Yii::app()->jump->success('发货，成功！', MAIN.'response/return/id/'.$_GET['id'].'/action/'.$_GET['action']);
				//Yii::app()->jump->success('发货，成功！', MERCHANT.'order/orderview/type/all');
			}
			else if($_GET['type'] == 3){
				Yii::app()->jump->error('发货，失败！原因未知。', MERCHANT.'order/error');
			} else {
			$this->redirect('error');
		}
	}
	
	public function actionerror()
	{
		echo '此页面不存在!!';
	}
}
?>