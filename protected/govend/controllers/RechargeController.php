<?php 
class RechargeController extends Controller
{
	public $layout = '//layouts/column2';
	public function actionRecharge(){
		$user_model = Merchant::model();
		$user_info = $user_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
		$user_recharge=Merchant::model();
		if(isset($_POST['Merchant']) && isset($user_info->merchant_email))
		{
			if($_POST['Merchant']['balance']>=0 && is_numeric($_POST['Merchant']['balance']))
			{
					$cm=new RechargeMerchant();
					$user_info->balance+=$_POST['Merchant']['balance'];
					Merchant::model()->updateAll(array('balance'=>$user_info->balance),'merchant_email=:email',array(':email'=>Yii::app()->user->name));
					$cm->merchant_name=$user_info->merchant_email;
					$cm->recharge=$_POST['Merchant']['balance'];
					$cm->date=date("Y-m-d H:i:m");
					$cm->ip=Yii::app()->request->userHostAddress;
					$cm->save();
					//$this->render('rechargesuccess',array('ali_balance'=>$_POST['Merchant']['balance']));
					Yii::app()->jump->success('充值成功！', MERCHANT.'recharge/recharge');
			}
			else
				Yii::app()->jump->error('充值失败！', MERCHANT.'recharge/recharge');
				//$this->render('rechargefalse');
		}
		else
			$this->render('recharge',array('user_recharge'=>$user_recharge));
		
	}
	public function actionRechargeUser()
	{
		$model=new RechargeMerchant('search');
		$model->unsetAttributes();  // clear any default values
		$model->merchant_name=Yii::app()->user->name;
		if(isset($_GET['RechargeMerchant'])){
			$model->attributes=$_GET['RechargeMerchant'];
		}
		$this->render('rechargeuser',array('model'=>$model));
	}
	
	public function actiontransferToUser()
	{
		if(isset($_POST['passwd']))
		{
			$user_pass=Merchant::model();
			$pay=$user_pass->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
			$user_model=User::model();
			$transfer=$user_model->findbypk($_POST[transfer_id]);
			if($pay->merchant_passwd==md5($_POST['passwd']))
			{
				// 							$user->ali_balance-=$_POST['price'];
				// 							$transfer->ali_balance+=$_POST['price'];
				// 							$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
				// 							$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
				// 							Yii::app()->jump->success('转账成功！', MERCHANT.'user/transfertouser');
				//echo $_POST[price]."! ".$_POST[transfer_id]."@ ".Yii::app()->userinfo->user_id;
				$pay->balance-=$_POST[price];
				$transfer->ali_balance+=$_POST[price];
				//echo $pay->ali_balance." ".$transfer->ali_balance;
				$pay->updatebypk($pay->merchant_id,array('balance'=>$pay->balance));
				$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
				
				$tm=new TransferFromMerchant();
				$tm->merchant_id=$pay->merchant_id;
				$tm->transfertoid=$transfer->user_id;
				$tm->transfertoemail=$transfer->ali_email;
				$tm->transfertoname=$transfer->user_name;
				$tm->price=$_POST[price];
				$tm->date=date("Y:m:d H:i:m");
				$tm->ip=Yii::app()->request->userHostAddress;
				$tm->type=3;
				$tm->save();
				
				$model=new TransferFromMerchant('search');
				$model->unsetAttributes();  // clear any default values
				$model->merchant_id=$pay->merchant_id;
				
				Yii::app()->jump->success('转账成功！', MERCHANT.'recharge/transferrecord',array('model'=>$model));
				//echo $pay->merchant_id." ".$pay->balance;
			}
			else
			{
				$error="转账密码错误";
				$this->render('transfer2',array('type'=>1,'transfer'=>$transfer,'price'=>$_POST[price],'error'=>$error));
				//Yii::app()->jump->error('您的账户金额不足，无法转账。', MERCHANT.'user/transfertouser');
			}
				
		}
		elseif(isset($_POST['transfer']) || isset($_POST['transfer2']) || isset($_POST['price']))
		{
				
			if($_POST['transfer']!=$_POST['transfer2'])
			{
				Yii::app()->jump->error('两次输入的账号不一致', MERCHANT.'recharge/transfertouser');
			}
			elseif(!is_numeric($_POST['price']) || $_POST['price']<0)
			{
				Yii::app()->jump->error('请输入正确的金额', MERCHANT.'recharge/transfertouser');
			}
				
			$merchant_model=Merchant::model();
			$user=$merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
			if($user->balance<$_POST['price'])
				Yii::app()->jump->error('您的账户金额不足，无法转账。', MERCHANT.'recharge/transfertouser');
			$user_model=User::model();	
			$transfer=$user_model->findbyattributes(array('user_name'=>$_POST['transfer']));
			if(!$transfer)
			{
				$transfer=$user_model->findbyattributes(array('ali_email'=>$_POST['transfer']));
				if(!$transfer)
				{
					Yii::app()->jump->error('您输入的账号不存在。', MERCHANT.'recharge/transfertouser');
				}
			}
			// 			$user->ali_balance-=$_POST['price'];
			// 			$transfer->ali_balance+=$_POST['price'];
			// 			$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
			// 			$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
			// 			Yii::app()->jump->success('转账成功！', MERCHANT.'user/transfertouser');
	
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
			$merchant_model=Merchant::model();
			$pay=$merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
			//$user_model=User::model();
			//$merchant_model=Merchant::model();
			$transfer=$merchant_model->findbypk($_POST[transfer_id]);
			if($pay->merchant_passwd==md5($_POST['passwd']))
			{
				
				// 							$user->ali_balance-=$_POST['price'];
				// 							$transfer->ali_balance+=$_POST['price'];
				// 							$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
				// 							$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
				// 							Yii::app()->jump->success('转账成功！', MERCHANT.'user/transfertouser');
				//echo $_POST[price]."! ".$_POST[transfer_id]."@ ".Yii::app()->userinfo->user_id;
	
				$pay=$merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
				$pay->balance-=$_POST[price];
				$transfer->balance+=$_POST[price];
				//echo $pay->ali_balance." ".$transfer->ali_balance;
				$pay->updatebypk($pay->merchant_id,array('balance'=>$pay->balance));
				$transfer->updatebypk($transfer->merchant_id,array('balance'=>$transfer->balance));
				
				$tm=new TransferFromMerchant();
				$tm->merchant_id=$pay->merchant_id;
				$tm->transfertoid=$transfer->merchant_id;
				$tm->transfertoemail=$transfer->merchant_email;
				$tm->transfertoname=$transfer->merchant_name;
				$tm->price=$_POST[price];
				$tm->date=date("Y:m:d H:i:m");
				$tm->ip=Yii::app()->request->userHostAddress;
				$tm->type=4;
				$tm->save();
				
				$model=new TransferFromMerchant('search');
				$model->unsetAttributes();  // clear any default values
				$model->merchant_id=$pay->merchant_id;
				
				Yii::app()->jump->success('转账成功！', MERCHANT.'recharge/transferrecord',array('model'=>$model));
					
			}
			else
			{
				$error="转账密码错误";
				$this->render('transfer2',array('type'=>2,'transfer'=>$transfer,'price'=>$_POST[price],'error'=>$error));
				//Yii::app()->jump->error('您的账户金额不足，无法转账。', MERCHANT.'user/transfertouser');
			}
				
		}
		elseif(isset($_POST['transfer']) || isset($_POST['transfer2']) || isset($_POST['price']))
		{
				
			if($_POST['transfer']!=$_POST['transfer2'])
			{
				Yii::app()->jump->error('两次输入的账号不一致', MERCHANT.'recharge/transfertouser');
			}
			elseif(!is_numeric($_POST['price']) || $_POST['price']<0)
			{
				Yii::app()->jump->error('请输入正确的金额', MERCHANT.'recharge/transfertouser');
			}
				
			$merchant_model=Merchant::model();
			$user=$merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
			if($user->balance<$_POST['price'])
				Yii::app()->jump->error('您的账户金额不足，无法转账。', MERCHANT.'recharge/transfertouser');
			//$merchant_model=Merchant::model();
			$transfer=$merchant_model->findbyattributes(array('merchant_name'=>$_POST['transfer']));
			if(!$transfer)
			{
				$transfer=$merchant_model->findbyattributes(array('merchant_email'=>$_POST['transfer']));
				if(!$transfer)
				{
					Yii::app()->jump->error('您输入的账号不存在。', MERCHANT.'recharge/transfertouser');
				}
			}
			// 			$user->ali_balance-=$_POST['price'];
			// 			$transfer->ali_balance+=$_POST['price'];
			// 			$user->updatebypk($user->user_id,array('ali_balance'=>$user->ali_balance));
			// 			$transfer->updatebypk($transfer->user_id,array('ali_balance'=>$transfer->ali_balance));
			// 			Yii::app()->jump->success('转账成功！', MERCHANT.'user/transfertouser');
	
			$this->render('transfer2',array('type'=>2,'transfer'=>$transfer,'price'=>$_POST[price]));
			//$this->redirect(array('user/transfer2'));
		}
		else
			$this->render('transfer',array('type'=>2));
	}
	public function actionTransferRecord()
	{
		$merchant_model=Merchant::model();
		$merchant=$merchant_model->findbyattributes(array('merchant_email'=>Yii::app()->user->name));
		$model=new TransferFromMerchant('search');
		$model->unsetAttributes();  // clear any default values
		$model->merchant_id=$merchant->merchant_id;
		
		$this->render('transferrecord',array('model'=>$model));
	}
}