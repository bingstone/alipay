<?php
class CountController extends Controller{

	public $layout = '//layouts/column2';

	/* function filters(){
		return array(
				'accessControl',
		);
	}

	function accessRules(){
		return array(
				array(
						'allow',
						'actions'=>array('usercount',),
						'users'=>array('@'),
				),
				array(
						'deny',
						'users'=>array('*')
				),
		);
	} */
	
	function actionHdata(){
		for ($index =0; $index<12; $index++){
			//$data[$index] = date('Y-m',strtotime("-".$index." Months"));
			$date[$index] = date('Y-m',strtotime("-".$index." Months"));
		}
		var_dump($date);
	}
	
	function actionTradeCount(){
		$if_show = array(false, false, false, false,);
		if(isset($_GET['type'])){
			if ($_GET['type']=='user') {				
				$sql="select sum(price) as total from {{ORDER}} where seller_email ='".Yii::app()->user->name."'"; 
				$result  = Yii::app()->db->createCommand($sql)->query();
				foreach ($result as $rs){
					$total = $rs['total'];
				}
				//$total = $order_model->count( 'seller_email = :name', array(':name' => Yii::app()->user->name ));
				for ($index =0; $index<12; $index++){
					$sql="select sum(price) as total from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''." and seller_email ='".Yii::app()->user->name."'";
					$result=Yii::app()->db->createCommand($sql)->query();
					foreach ($result as $rs){
						$data[$index] = $rs['total'];
					}
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}
				/*
				for ($index =0; $index<12; $index++){
					$sql="select sum(price) from {{ORDER}} where buyer_email =".addslashes(Yii::app()->user->name);
					$data[$index]=Yii::app()->db->createCommand($sql)->query();
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}*/
				$if_show[1] = true;
			} else if ($_GET['type']=='finance'){
				$sql = "select sum(price) as total from {{ORDER}} where seller_email='".Yii::app()->user->name."' ";
				$result  = Yii::app()->db->createCommand($sql)->query();
				foreach ($result as $rs){
					$total = $rs['total'];
				}		
				
				$sql = "select sum(price) as total_price from {{ORDER}} where seller_email='".Yii::app()->user->name."' and status_id = 9";
				$result  = Yii::app()->db->createCommand($sql)->query();
				foreach ($result as $rs){
					$total_price = $rs['total_price'];
				}

				for ($index =0; $index<12; $index++){
					$sql1 = "select sum(price) as monthly_price from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\'';
					$result1  = Yii::app()->db->createCommand($sql1)->query();
					foreach ($result1 as $rs1){
						$monthly_price[$index] = $rs1['monthly_price'];
						Yii::log('monthly_price'.$index.'='.$monthly_price[$index]);
					}
					
					
					$sql2 = "select sum(price) as monthly_price_success from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''." and status_id = 9";
					$result2  = Yii::app()->db->createCommand($sql2)->query();
					foreach ($result2 as $rs2){
						$monthly_price_success[$index] = $rs2['monthly_price_success'];
					}

					
					$sql3 = "select sum(price) as monthly_price_pending from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''." and (status_id = 1 or status_id = 4 or status_id = 6)";
					$result3  = Yii::app()->db->createCommand($sql3)->query();
					foreach ($result3 as $rs3){
						$monthly_price_pending[$index] = $rs3['monthly_price_pending'];
					}
					
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}
				
				/*
				$merchant_model =Merchant::model();
				$balance_data[0] = $merchant_model->count('balance = 0 ');
				$balance_data[1] = $merchant_model->count('balance >0 and balance <= 50');
				$balance_data[2] = $merchant_model->count('balance >50 and balance <= 100');
				$balance_data[3] = $merchant_model->count('balance >100 and balance <= 200');
				$balance_data[4] = $merchant_model->count('balance >200 and balance <= 500');
				$balance_data[5] = $merchant_model->count('balance >500 and balance <= 1000');
				$balance_data[6] = $merchant_model->count('balance >1000 and balance <= 2000');
				$balance_data[7] = $merchant_model->count('balance >2000 and balance <= 5000');
				$balance_data[8] = $merchant_model->count('balance >5000 and balance <= 10000');
				$balance_data[9] = $merchant_model->count('balance >10000 and balance <= 50000');
				$balance_data[10] = $merchant_model->count('balance >50000 and balance <= 100000');
				$balance_data[11] = $merchant_model->count('balance >100000');*/
				$if_show[2] = true;
			} else {
				/*$order_model = Order::model();
				$total = $order_model->count();
				$data[0]=0;
				$data_pending[0]=0;
				$data_success[0]=0;
				for ($index =0; $index<12; $index++){
					$data[$index] = $order_model->count('order_add_time like :date ', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
					
					$data_success[$index] = $order_model->count('order_add_time like :date and status_id = 9', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
					
					$data_pending[$index] = $order_model->count('order_add_time like :date and (status_id = 1 or status_id = 4 or status_id = 6)', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
									
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}
				*/
				
				
				/*$countcriteria = new CDbCriteria();
				$countcriteria->select=array('t.merchant_id', 't.merchant_name', 't.merchant_phone', 't.merchant_email', 't.trade_amount', 't.merchant_country', 't.merchant_addtime');
				$countcriteria->offset =5;
				$countcriteria->order ='trade_amount DESC';
				$countdataProvider = new CActiveDataProvider('Merchant',array(
						'criteria'=>$countcriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$merchant_model =Merchant::model();
				$trade_count[0] = $merchant_model->count('trade_amount = 0 ');
				$trade_count[1] = $merchant_model->count('trade_amount >0 and trade_amount <=5');
				$trade_count[2] = $merchant_model->count('trade_amount >5 and trade_amount <=10');
				$trade_count[3] = $merchant_model->count('trade_amount >10 and trade_amount <=20');
				$trade_count[4] = $merchant_model->count('trade_amount >20 and trade_amount <=50');
				$trade_count[5] = $merchant_model->count('trade_amount >50 and trade_amount <=100');
				$trade_count[6] = $merchant_model->count('trade_amount >100 and trade_amount <=150');
				$trade_count[7] = $merchant_model->count('trade_amount >150 and trade_amount <=300');
				$trade_count[8] = $merchant_model->count('trade_amount >300 and trade_amount <=600');
				$trade_count[9] = $merchant_model->count('trade_amount >600 and trade_amount <=1000');
				$trade_count[10] = $merchant_model->count('trade_amount >1000 and trade_amount <=2000');
				$trade_count[11] = $merchant_model->count('trade_amount >2000 and trade_amount <=5000');
				$trade_count[12] = $merchant_model->count('trade_amount >5000 and trade_amount <=10000');
				$trade_count[13] = $merchant_model->count('trade_amount >10000 and trade_amount <=50000');
				$trade_count[14] = $merchant_model->count('trade_amount >50000 and trade_amount <=100000');
				$trade_count[15] = $merchant_model->count('trade_amount >100000');
				$moneycriteria = new CDbCriteria();
				$moneycriteria->select=array('t.merchant_id', 't.merchant_name', 't.merchant_phone', 't.merchant_email', 't.tarde_finance', 't.merchant_country', 't.merchant_addtime');
				$moneycriteria->offset =5;
				$moneycriteria->order ='tarde_finance DESC';
				$moneydataProvider = new CActiveDataProvider('Merchant',array(
						'criteria'=>$moneycriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$trade_money[0] = $merchant_model->count('tarde_finance = 0 ');
				$trade_money[1] = $merchant_model->count('tarde_finance >0 and tarde_finance <=100');
				$trade_money[2] = $merchant_model->count('tarde_finance >100 and tarde_finance <=500');
				$trade_money[3] = $merchant_model->count('tarde_finance >500 and tarde_finance <=1000');
				$trade_money[4] = $merchant_model->count('tarde_finance >1000 and tarde_finance <=3000');
				$trade_money[5] = $merchant_model->count('tarde_finance >3000 and tarde_finance <=6000');
				$trade_money[6] = $merchant_model->count('tarde_finance >6000 and tarde_finance <=10000');
				$trade_money[7] = $merchant_model->count('tarde_finance >10000 and tarde_finance <=15000');
				$trade_money[8] = $merchant_model->count('tarde_finance >15000 and tarde_finance <=20000');
				$trade_money[9] = $merchant_model->count('tarde_finance >20000 and tarde_finance <=50000');
				$trade_money[10] = $merchant_model->count('tarde_finance >50000 and tarde_finance <=100000');
				$trade_money[11] = $merchant_model->count('tarde_finance >100000 and tarde_finance <=500000');
				$trade_money[12] = $merchant_model->count('tarde_finance >500000 and tarde_finance <=1000000');
				$trade_money[13] = $merchant_model->count('tarde_finance >1000000');*/
// 				$sql = "select buyer_id as id,receive_name as name ,receive_mobile as mobile,sum(price) as price,buyer_email as email from {{ORDER}} where buyer_id is not null && seller_email='".Yii::app()->user->name."' group by buyer_id order by sum(price) desc limit 5 ";
// 				$result  = Yii::app()->db->createCommand($sql)->query();
// 				$index=0;
// 				foreach ($result as $rs){
// 					$id[$index] = $rs['id'];
// 					$name[$index] = $rs['name'];
// 					$mobile[$index]=$rs['mobile'];
// 					$price[$index]=$rs['price'];
// 					$email[$index++]=$rs['email'];
// 				}
				$moneycriteria = new CDbCriteria();
				$moneycriteria->select="buyer_id, receive_name, price,receive_mobile,  buyer_email";
				$moneycriteria->addCondition("seller_email='".Yii::app()->user->name."'");
				$moneycriteria->addCondition("buyer_id is not null");
				$moneycriteria->offset =5;
				$moneycriteria->order ='sum(price) DESC,buyer_id';
				$moneycriteria->group ='buyer_id';
				$countdataProvider = new CActiveDataProvider('Order',array(
						'criteria'=>$moneycriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$if_show[3] = true;
			}
		} else {
			$if_show[0] = true;
		}

		if($if_show[1])
			$this->render('trade', array('if_show'=>$if_show, 'total'=>$total ,'data'=>$data, 'date'=>$date,));
		else if ($if_show[2])
			$this->render('trade', array('if_show'=>$if_show, 'total'=>$total, 'total_price'=>$total_price, 'monthly_price'=>$monthly_price,'monthly_price_success'=>$monthly_price_success,'monthly_price_pending'=>$monthly_price_pending, 'date'=>$date,));
		else if ($if_show[3])
			$this->render('trade', array('if_show'=>$if_show, 'countdataProvider'=>$countdataProvider,'id'=>$id,'name'=>$name,'mobile'=>$mobile,'price'=>$price,'email'=>$email,));
		else
			$this->render('trade', array('if_show'=>$if_show,));
	}

	function actionOrderCount(){
		$if_show = array(false, false, false, false,);
		if(isset($_GET['type'])){
			if ($_GET['type']=='merchant') {				
				$total = Order::model()->count( 'seller_email = :name', array(':name' => Yii::app()->user->name ));
				for ($index =0; $index<12; $index++){
					$data[$index] = Order::model()->count('order_add_time like :date && seller_email = :name', array(':name'=>Yii::app()->user->name,':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}
				/*
				for ($index =0; $index<12; $index++){
					$sql="select sum(price) from {{ORDER}} where buyer_email =".addslashes(Yii::app()->user->name);
					$data[$index]=Yii::app()->db->createCommand($sql)->query();
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}*/
				$if_show[1] = true;
			} else if ($_GET['type']=='finance'){
				//$order_model = Order::model();
				//$total = $order_model->count();				
				$total = Order::model()->count( 'seller_email = :name', array(':name' => Yii::app()->user->name ));
				$total_price = Order::model()->count( 'seller_email = :name && status_id=9', array(':name' => Yii::app()->user->name ));
				/*$sql = "select count(price) as total_price from {{ORDER}} where status_id =9";
				$result  = Yii::app()->db->createCommand($sql)->query();
				foreach ($result as $rs){
					$total_price = $rs['total_price'];
				}
				*/
				for ($index =0; $index<12; $index++){
					$sql1 = "select count(price) as monthly_price from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''."and seller_email='".Yii::app()->user->name."'";
					$result1  = Yii::app()->db->createCommand($sql1)->query();
					foreach ($result1 as $rs1){
						$monthly_price[$index] = $rs1['monthly_price'];
						Yii::log('monthly_price'.$index.'='.$monthly_price[$index]);
					}
					
					
					$sql2 = "select count(price) as monthly_price_success from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''." and status_id = 9 and seller_email='".Yii::app()->user->name."'";
					$result2  = Yii::app()->db->createCommand($sql2)->query();
					foreach ($result2 as $rs2){
						$monthly_price_success[$index] = $rs2['monthly_price_success'];
					}

					
					$sql3 = "select count(price) as monthly_price_pending from {{ORDER}} where order_add_time like '".date('Y-m',strtotime("-".$index." Months")).'%\''." and (status_id = 1 or status_id = 4 or status_id = 6) and seller_email='".Yii::app()->user->name."'";
					$result3  = Yii::app()->db->createCommand($sql3)->query();
					foreach ($result3 as $rs3){
						$monthly_price_pending[$index] = $rs3['monthly_price_pending'];
					}
					
					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
				}
				
				/*
				$merchant_model =Merchant::model();
				$balance_data[0] = $merchant_model->count('balance = 0 ');
				$balance_data[1] = $merchant_model->count('balance >0 and balance <= 50');
				$balance_data[2] = $merchant_model->count('balance >50 and balance <= 100');
				$balance_data[3] = $merchant_model->count('balance >100 and balance <= 200');
				$balance_data[4] = $merchant_model->count('balance >200 and balance <= 500');
				$balance_data[5] = $merchant_model->count('balance >500 and balance <= 1000');
				$balance_data[6] = $merchant_model->count('balance >1000 and balance <= 2000');
				$balance_data[7] = $merchant_model->count('balance >2000 and balance <= 5000');
				$balance_data[8] = $merchant_model->count('balance >5000 and balance <= 10000');
				$balance_data[9] = $merchant_model->count('balance >10000 and balance <= 50000');
				$balance_data[10] = $merchant_model->count('balance >50000 and balance <= 100000');
				$balance_data[11] = $merchant_model->count('balance >100000');*/
				$if_show[2] = true;
			} else {
// 				$order_model = Order::model();
// 				$total = $order_model->count();
// 				$data[0]=0;
// 				$data_pending[0]=0;
// 				$data_success[0]=0;
// 				for ($index =0; $index<12; $index++){
// 					$data[$index] = $order_model->count('order_add_time like :date ', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
					
// 					$data_success[$index] = $order_model->count('order_add_time like :date and status_id = 9', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
					
// 					$data_pending[$index] = $order_model->count('order_add_time like :date and (status_id = 1 or status_id = 4 or status_id = 6)', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
									
// 					$date[$index] = date('Y-m',strtotime("-".$index." Months"));
// 				}
				
				
				
				/*$countcriteria = new CDbCriteria();
				$countcriteria->select=array('t.merchant_id', 't.merchant_name', 't.merchant_phone', 't.merchant_email', 't.trade_amount', 't.merchant_country', 't.merchant_addtime');
				$countcriteria->offset =5;
				$countcriteria->order ='trade_amount DESC';
				$countdataProvider = new CActiveDataProvider('Merchant',array(
						'criteria'=>$countcriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$merchant_model =Merchant::model();
				$trade_count[0] = $merchant_model->count('trade_amount = 0 ');
				$trade_count[1] = $merchant_model->count('trade_amount >0 and trade_amount <=5');
				$trade_count[2] = $merchant_model->count('trade_amount >5 and trade_amount <=10');
				$trade_count[3] = $merchant_model->count('trade_amount >10 and trade_amount <=20');
				$trade_count[4] = $merchant_model->count('trade_amount >20 and trade_amount <=50');
				$trade_count[5] = $merchant_model->count('trade_amount >50 and trade_amount <=100');
				$trade_count[6] = $merchant_model->count('trade_amount >100 and trade_amount <=150');
				$trade_count[7] = $merchant_model->count('trade_amount >150 and trade_amount <=300');
				$trade_count[8] = $merchant_model->count('trade_amount >300 and trade_amount <=600');
				$trade_count[9] = $merchant_model->count('trade_amount >600 and trade_amount <=1000');
				$trade_count[10] = $merchant_model->count('trade_amount >1000 and trade_amount <=2000');
				$trade_count[11] = $merchant_model->count('trade_amount >2000 and trade_amount <=5000');
				$trade_count[12] = $merchant_model->count('trade_amount >5000 and trade_amount <=10000');
				$trade_count[13] = $merchant_model->count('trade_amount >10000 and trade_amount <=50000');
				$trade_count[14] = $merchant_model->count('trade_amount >50000 and trade_amount <=100000');
				$trade_count[15] = $merchant_model->count('trade_amount >100000');
				$moneycriteria = new CDbCriteria();
				$moneycriteria->select=array('t.merchant_id', 't.merchant_name', 't.merchant_phone', 't.merchant_email', 't.tarde_finance', 't.merchant_country', 't.merchant_addtime');
				$moneycriteria->offset =5;
				$moneycriteria->order ='tarde_finance DESC';
				$moneydataProvider = new CActiveDataProvider('Merchant',array(
						'criteria'=>$moneycriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$trade_money[0] = $merchant_model->count('tarde_finance = 0 ');
				$trade_money[1] = $merchant_model->count('tarde_finance >0 and tarde_finance <=100');
				$trade_money[2] = $merchant_model->count('tarde_finance >100 and tarde_finance <=500');
				$trade_money[3] = $merchant_model->count('tarde_finance >500 and tarde_finance <=1000');
				$trade_money[4] = $merchant_model->count('tarde_finance >1000 and tarde_finance <=3000');
				$trade_money[5] = $merchant_model->count('tarde_finance >3000 and tarde_finance <=6000');
				$trade_money[6] = $merchant_model->count('tarde_finance >6000 and tarde_finance <=10000');
				$trade_money[7] = $merchant_model->count('tarde_finance >10000 and tarde_finance <=15000');
				$trade_money[8] = $merchant_model->count('tarde_finance >15000 and tarde_finance <=20000');
				$trade_money[9] = $merchant_model->count('tarde_finance >20000 and tarde_finance <=50000');
				$trade_money[10] = $merchant_model->count('tarde_finance >50000 and tarde_finance <=100000');
				$trade_money[11] = $merchant_model->count('tarde_finance >100000 and tarde_finance <=500000');
				$trade_money[12] = $merchant_model->count('tarde_finance >500000 and tarde_finance <=1000000');
				$trade_money[13] = $merchant_model->count('tarde_finance >1000000');*/
// 				$sql = "select buyer_id as id,receive_name as name ,receive_mobile as mobile,count(price) as price,buyer_email as email from {{ORDER}} where buyer_id is not null && seller_email='".Yii::app()->user->name."' group by buyer_id order by count(price) desc limit 5 ";
// 				$result  = Yii::app()->db->createCommand($sql)->query();
// 				$index=0;
// 				foreach ($result as $rs){
// 					$id[$index] = $rs['id'];
// 					$name[$index] = $rs['name'];
// 					$mobile[$index]=$rs['mobile'];
// 					$price[$index]=$rs['price'];
// 					$email[$index++]=$rs['email'];
// 				}
				$moneycriteria = new CDbCriteria();
				$moneycriteria->select='buyer_id, receive_name,count(price) as total,receive_mobile,  buyer_email';
				$moneycriteria->addCondition("seller_email='".Yii::app()->user->name."'");
				$moneycriteria->addCondition("buyer_id is not null");
				$moneycriteria->offset =5;
				$moneycriteria->order ='count(price) DESC,buyer_id';
				$moneycriteria->group ='buyer_id';
				$countdataProvider = new CActiveDataProvider('Order',array(
						'criteria'=>$moneycriteria,
						'pagination'=>array(
								'pageSize'=>5
						),
				));
				$if_show[3] = true;
			}
		} else {
			$if_show[0] = true;
		}

		if($if_show[1])
			$this->render('order', array('if_show'=>$if_show, 'total'=>$total ,'data'=>$data, 'date'=>$date,));
		else if ($if_show[2])
			$this->render('order', array('if_show'=>$if_show, 'total'=>$total, 'total_price'=>$total_price, 'monthly_price'=>$monthly_price,'monthly_price_success'=>$monthly_price_success,'monthly_price_pending'=>$monthly_price_pending, 'date'=>$date,));
		else if ($if_show[3])
			$this->render('order', array('if_show'=>$if_show, 'countdataProvider'=>$countdataProvider,'id'=>$id,'name'=>$name,'mobile'=>$mobile,'price'=>$price,'email'=>$email,));
		else
			$this->render('order', array('if_show'=>$if_show,));
	}
	
	function actionTest(){
		//var_dump( Yii::app()->user->name);
		/* $total = User::model()->count();
		echo $total;
		for ($index =0; $index<12; $index++){
			$arry[11 - $index] = User::model()->count('user_addtime like :date ', array(':date' => date('Y-m',strtotime("-".$index." Months")).'%'));
		} */
		//$arry = User::model()->count('user_addtime like :date ', array(':date' => date('Y-m',strtotime("-2 Months")).'%'));
		//echo $arry;
		//$sql_balance = "select sum(ali_balance) as total_balance from {{USER}}";
		//$sql_balance = "select sum(ali_balance) as total_balance, sum(ali_freeze) as total_freeze from {{USER}}";
		//$result = Yii::app()->db->createCommand($sql_balance)->query();
		//echo $result['total_balance'];
		/* foreach ($result as $rs){
		/	$rs_ba = $rs['total_balance'];			
			$rs_fr = $rs['total_freeze'];
			//print_r($rs);
		}
		echo $rs_ba;
		echo '<br>';
		echo $rs_fr; */
		//$balance_result as $rs;
		//print_r($result);
		$model=new Merchant();
		$mod=$model->findbypk(12345678991128);
		echo $mod->key_value;
		
	}
}

?>