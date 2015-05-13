<?php

class OrderController extends Controller{
	
  
  public function actionAddOrder(){

      echo '--'.'addorder'.'<br/>';
    exit();
    $this->render('orderShow',
        array('order_model'=>$order_model,
            'mercant_info'=>$Mercant_result,
        )
    );
  }
  
  
  /*
   * 接收参数的方法,并设置Flash
   */
  public function actionOrderRec(){
    
    //设置Flash,数据插入order表之前必须要从这个方法中跳过去
    Yii::app()->user->setFlash('submit','thanks');
    
	  //1.编码方式
	  if(isset($_GET['_input_charset']))
  	  $_input_charset=$_GET['_input_charset'];
    
	  //2.订单描述
    if(isset($_GET['body']))
      $body=$_GET['body'];

    //3.物流费用
    if(isset($_GET['logistics_fee']))
      $logistics_fee=$_GET['logistics_fee'];
	  
    //4.物流支付方式
    //必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
    if(isset($_GET['logistics_payment']))
      $logistics_payment=$_GET['logistics_payment'];
	  
    //5.物流类型
    if(isset($_GET['logistics_type']))
      $logistics_type=$_GET['logistics_type'];
	  
    //6.服务器异步通知页面路径
    if(isset($_GET['notify_url']))
      $notify_url=$_GET['notify_url'];
	  
    //7.商户订单号
    if(isset($_GET['out_trade_no']))
      $out_trade_no=$_GET['out_trade_no'];
	  
    //8.支付类型
    if(isset($_GET['payment_type']))
      $payment_type=$_GET['payment_type'];
	  
    //9.付款金额
    if(isset($_GET['price']))
      $price=$_GET['price'];
    
    //10.商品数量
    if(isset($_GET['quantity']))
      $quantity=$_GET['quantity'];
	  
    //11.收货人地址
    if(isset($_GET['receive_address']))
      $receive_address=$_GET['receive_address'];
	  
    //12.收货人手机号码
    if(isset($_GET['receive_mobile']))
      $receive_mobile=(int)$_GET['receive_mobile'];

    //13.收货人姓名
    if(isset($_GET['receive_name']))
      $receive_name=$_GET['receive_name'];
	  
    //14.收货人电话号码
    if(isset($_GET['receive_phone']))
      $receive_phone=$_GET['receive_phone'];
	  
    //15.收货人邮编
    if(isset($_GET['receive_zip']))
      $receive_zip=(int)$_GET['receive_zip'];
	  
    //16.页面跳转同步通知页面路径
    if(isset($_GET['return_url']))
      $return_url=$_GET['return_url'];
	  
    //17.卖家支付宝帐户
    if(isset($_GET['seller_email']))
      $seller_email=$_GET['seller_email'];
    
    //18.商品展示地址
    if(isset($_GET['show_url']))
      $show_url=$_GET['show_url'];
	  
    //19.订单名称
    if(isset($_GET['subject']))
      $subject=$_GET['subject'];
	  
    //20.签名值
    if(isset($_GET['sign']))
      $sign=$_GET['sign'];
	  
    //21.签名方式
    if(isset($_GET['sign_type']))
      $sign_type=$_GET['sign_type'];
    
    //22.卖家标识号
    if(isset($_GET['partner']))
      $partner=trim($_GET['partner']);
    
    //23.支付宝接口类型
    if(isset($_GET['service']))
      $service=trim($_GET['service']);
	  
    //构造要接收请求订单参数的参数数组，无需改动
    $parameter = array(
        'service' => $service,
        'partner' => trim($partner),
        'payment_type'	=> $payment_type,
        'notify_url'	=> urlencode($notify_url),
        'return_url'	=> urlencode($return_url),
        'seller_email' => trim($seller_email),
        'out_trade_no'	=> $out_trade_no,        
        'subject'	=> $subject,
        'price'	=> $price,
        'quantity'	=> $quantity,
        'logistics_fee'	=> $logistics_fee,
        'logistics_type'	=> $logistics_type,
        'logistics_payment'	=> $logistics_payment,
        'body'	=> $body,
        'show_url'	=> urlencode($show_url),
        'receive_name'	=> $receive_name,
        'receive_address'	=> $receive_address,
        'receive_zip'	=> $receive_zip,
        'receive_phone'	=> $receive_phone,
        'receive_mobile'	=> $receive_mobile,
        '_input_charset'	=> trim(strtolower($_input_charset)),
        'sign_type' => $sign_type,
        'sign' => $sign
    );
    
    // 连接真实商户网站时，debug
    //$parameter['notify_url'] = urldecode($parameter['notify_url']);
    //$parameter['return_url'] = urldecode($parameter['return_url']);
    //$parameter['show_url'] = urldecode($parameter['show_url']);
/*     foreach ($parameter as $_k => $_v ){
      echo $_k.'---->'.$_v.'<br/>';
    }
    exit; */
    // 连接真实商户网站时，debug
     $this->redirect(array('orderinsert', 'OrderArray'=>json_encode($parameter), ));
//     $this->redirect(array('orderinsert', 'OrderArray'=>json_encode($model) ,));
//     $this->redirect(array('orderinsert', 'OrderArray'=>$parameter ,));
	}
	
	
  /*
   * 参数处理,数据插入
   */
	public function  actionOrderInsert(){

    /*已设置Flash值,首次提交*/
	  if(Yii::app()->user->hasFlash('submit')){
	    Yii::app()->user->getFlash('submit');
	    
	    $OrderArray = $_GET['OrderArray'];
	    
	    $parameter = json_decode($OrderArray, true);
	    
	    $parameter['notify_url'] = urldecode($parameter['notify_url']);
	    $parameter['return_url'] = urldecode($parameter['return_url']);
	    $parameter['show_url'] = urldecode($parameter['show_url']);
	    
/* 	    
      foreach ($parameter as $k => $v){
	      echo $k.'-->'.$v.'<br/>';
	    }
	    echo 'aa  ';
	    exit();
 */    
  	  $oderCheck = new OrderReceive($parameter);
      $Mercant_result = $oderCheck->verifyMerchant();

//       echo '<br/>'.'asdad'.'<br/>';
      /************商户存在-begin************/
      if(!empty($Mercant_result)) {
        $verify_result = $oderCheck->verifyOrder();
        
        /****订单验证通过-order数据插入--begin*/
        if($verify_result){
//           echo 'Through the verification'.'<br/';
          //验证通过,把数据插入到order表中
          //parameter中23个参数,除server参数外,都需要插入到order表中
          //orderParamentArray数组,是去掉server参数之后的数组
          //$oderParamentArray = $parameter;
          //unset($oderParamentArray['service']);
    
          //构造要填充order表的参数数组
          $oderParamentArray = array(
              'partner' => $parameter['partner'],
              'payment_type'	=> (int)$parameter['payment_type'],
              'notify_url'	=> $parameter['notify_url'],
              'return_url'	=> $parameter['return_url'],
//               'seller_email' => $parameter['seller_email'],
              'seller_email' => $Mercant_result['merchant_email'],
              'out_trade_no'	=> (int)$parameter['out_trade_no'],
              'subject'	=> $parameter['subject'],
              'price'	=> (float)$parameter['price'],
              'quantity'	=> (int)$parameter['quantity'],
              'logistics_fee'	=> (float)$parameter['logistics_fee'],
              'logistics_type'	=> $parameter['logistics_type'],
              'logistics_payment'	=> $parameter['logistics_payment'],
              'body'	=> $parameter['body'],
              'show_url'	=> $parameter['show_url'],
              'receive_name'	=> $parameter['receive_name'],
              'receive_address'	=> $parameter['receive_address'],
              'receive_zip'	=> (int)$parameter['receive_zip'],
              'receive_phone'	=> (int)$parameter['receive_phone'],
              'receive_mobile'	=> (int)$parameter['receive_mobile'],
              '_input_charset'	=> $parameter['_input_charset'],
              'sign_type' => $parameter['sign_type'],
              'sign' => $parameter['sign']
              );

          //$order_model = new RawOrder();
          $order_model = new Order();
          //$merchant_form = new CForm($merchant_model->getAddConfig(),$merchant_model);
    
//           print_r($oderParamentArray);
//           exit();
          //$order_model -> buyer_id = NULL;
          //$order_model -> trade_type_id = 1;
          //$order_model -> buyer_email = NULL;
          $order_model -> attributes = $oderParamentArray;
          $order_model -> ali_order_id = (int)(date(Ymd,time()).'01'.rand(100,899).substr(strtotime(date(His,time())),-4));
          $order_model -> order_add_time = date("Y-m-d H:i:s");
          $order_model -> order_update_time = date("Y-m-d H:i:s");
          $order_model -> status_id = 1;//1状态：等待买家付款
          
//           var_dump($order_model -> attributes);
          if($order_model -> save()){
            //$this->actionAddOrder($order_model, $Mercant_result);
            $this->render('orderShow',
                  array('order_model'=>$order_model,
                      'mercant_info'=>$Mercant_result,
                  )
            );
            //$this -> redirect(array('AddOrder','order_model'=>$order_model));
            //$this -> createUrl(MAIN.'order/AddOrder',array('order_model'=>$order_model, 'Mercant_result'=>$Mercant_result));
          }
          else{
            $this->render('orderErr',
                array('order_model'=>$order_model,)
            );
          }
        }
        /****订单验证通过-order表数据插入--end*/
    
        /****订单验证不通过******/
        else{
          echo 'errrr';
          $this ->render('commitErr');
        }
        /****订单验证不通过******/
    
      }
      /************商户存在-end************/
    
      /************商户不存在-begin************/
      else {
        $this ->render('MerchantNotExsist');
      }
      /************商户不存在-end************/
	  }
	  
	  /*未设置Flash值,重复提交*/
	  else
	    echo '订单已处理！！';
  }


  /*
   * 用户填写身份信息，以补充订单
   * 
   */
  public function actionAddUser(){


//     foreach ($_POST as $_k => $_v)
//       echo $_v.'<br/>';

    if(isset($_POST['order_id']) && Yii::app()->request->isPostRequest){
      $order_id = $_POST['order_id'];
      
    }
    else{
      if (!empty($_GET))
        $order_id = $_GET['ali_order_id'];
    }
//     $user_info = CheckUser()
    
//   
   
    //echo $orderID;
//     $admin_login = new AdminLoginForm;
//     if(!empty($_POST['AdminLoginForm']) && Yii::app()->request->isPostRequest ){
//       $admin_login->attributes = $_POST['AdminLoginForm'];
//       if($admin_login->validate() && $admin_login->login()){
//         $this->redirect(MANAGE.'index');
//       }
//     }
//     $this->render('login', array('admin_login'=>$admin_login));

    
//     $order_user = new Order();
    $this ->render('orderAddUser',array('id' => $order_id, ));
    //echo '用户补充订单！！';



  }
  
  public function actionCheckUser(){

    //接收到post数据
    if(Yii::app()->request->isPostRequest){
      $orderUser = $_POST;
//       echo $orderUser['email'];
//       echo $orderUser['order_id'];
//       var_dump($orderUser);
//       exit();
      
      
      
      $user_info = Yii::app()->db->createCommand()
          ->from('{{USER}}')
          ->where('ali_email = :ali_email',array('ali_email'=>$orderUser['email']))
          ->queryRow();
      
      if(!empty($user_info)){	//判断是否查询到该用户
        echo '存在此用户：'.$user_info['user_name'].'<br/>';
        
        $user_pay_passwd_info = Yii::app()->db->createCommand()
          ->select( 'u.user_id, u.user_name, u.user_passwd, u.ali_email, p.id, p.user_id, p.pay_passwd' )
          ->from('{{PAY_PASSWD}} p')
          ->leftJoin('{{USER}} u' , 'p.user_id=u.user_id ')
          ->where('u.ali_email = :email',array('email'=>$orderUser['email']))
          ->queryRow();
        
        if(!empty($user_pay_passwd_info)){	//判断该用户是否设置了支付密码
          echo '此用户存在支付密码<br/>系统内md5密码:'.$user_pay_passwd_info['pay_passwd'].'<br/>用户输入：'.$orderUser['pay_wd'].'-->'.md5($orderUser['pay_wd']).'<br/>';
          if($user_pay_passwd_info['pay_passwd'] === md5($orderUser['pay_wd'])){
            echo '支付密码输入正确,更新订单';
            
            $orderUser_model = Order::model();
            $order_info = $orderUser_model -> findByPk($orderUser['order_id']);
            /* foreach($order_info as $_k=> $_v){
                    echo $_k  .'->'.$_v.'<br/>';
            }
            exit(); */
            if(!empty($order_info)){
              $order_info -> buyer_email = $orderUser['email'];
              $order_info -> order_update_time = date("Y-m-d H:i:s");
              if($order_info -> save()){
              //$this -> redirect(ADMIN.'/manager/showmerchant');
              
                WebMessage::success('买家信息更新到order订单数据表，成功！<br/>前去付款',MAIN.'index/login',5);
              //echo '买家信息更新到order订单数据表，成功！';
              //$this->redirect(array('/user/login', ));
              }
              else 
                WebMessage::error('买家信息更新到order订单数据表，失败！','',3);
              exit();
//                 $this->layout = false;
//                 $this->render('updatemerchant',array('merchant_info' => $merchant_info,));
            }
            else{
              WebMessage::error('数据丢失，请去官网重新下单','',3);
            }
               
          }
          else 
            WebMessage::error('支付密码输入错误,重新输入','',3);
        }
        else 
          WebMessage::error('此用户不存在支付密码<br/>,去设置支付密码','',3);
      }
      else{
        echo '查无此用户，先去注册！'.'</br>跳转到买家注册接口！';
        //$this->redirect(array('adduser', 'ali_order_id'=>$orderUser['order_id'], ));
      }
      
    }
    else
      echo '数据接收失败！';
    
    
  }

}