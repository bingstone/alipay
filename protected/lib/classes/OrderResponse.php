<?php
/*****************************************************************************
 * 
 * @name：AlipayResponse
 * @function：支付宝各响应参数构造类
 * 详细：第三方支付平台根据订单参数，进行订单响应 
 * @charset UTF-8
 * @author wulin
 * @time 2014-12-29
 * @version 0.1
 *****************************************************************************/

//require_once(CLASSES."/core.function/md5.php");
//require_once("alipay_md5.function.php");

class AlipayResponse{

  /*
   * 响应ID
   */
  var $notify_id;
  
  /*
   * 订单参数数组
   */
	var $order_array;
	
	/*
	 * 商户信息
	 */
	var $merchant_info;
	
	function __construct($order_id){
	  
	  $this->notify_id =  md5($order_id).$this->getRandChar(32);//订单号加密串+32位随机字符串
	  
		$order_model= Order::model()->findByPk($order_id);
    foreach ($order_model AS $_K => $_V){
      $this->order_array[$_K]=$_V;
    }
    
    //debug
    print_r($this->order_array);
    
    $merchant_model = Merchant::model()->findByPk($this->order_array['partner']);
    foreach ($merchant_model AS $_K => $_V){
      $this->merchant_info[$_K]=$_V;
    }
    
    //debug
    print_r($this->merchant_info);
    
	}
	
	/**
	 * @abstract 取出订单信息和商户信息
	 * 
	 * @param $order_id 要进行响应操作的订单号
	 * @param $action 要进行响应操作的动作
	 */
  function AlipayResponse($order_id) {
    $this->order_array = array();
    $this->merchant_info = array();
    $this->__construct($order_id);
  }
	
	/**
	 * @abstract 生成签名结果
	 * @param $para_sort 已排序要签名的数组
	 * return 签名结果字符串
	 */
	function buildRequestMysign($para_sort) {
		//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = createLinkstring($para_sort);
		
// 		echo '<br/>--'.$prestr.'--<br/>';exit();
		
		$mysign = "";
		switch (strtoupper(trim($this->order_array['sign_type']))) {
			case "MD5" :
				$mysign = md5Sign($prestr, $this->merchant_info['key_value']);
				break;
			default :
				$mysign = "";
		}
		
		return $mysign;
	}

	/**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组
     */
	function buildRequestPara($para_temp) {
		//除去待签名参数数组中的空值和签名参数
		$para_filter = paraFilter($para_temp);

		//对待签名参数数组排序
		$para_sort = argSort($para_filter);

		//生成签名结果
		$mysign = $this->buildRequestMysign($para_sort);
		
		//签名结果与签名方式加入请求提交参数组中
		$para_sort['sign'] = $mysign;
		$para_sort['sign_type'] = strtoupper(trim($this->order_array['sign_type']));
		
		return $para_sort;
	}

	/**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组字符串
     */
	function buildRequestParaToString($para_temp) {
		//待请求参数数组
		$para = $this->buildRequestPara($para_temp);
		
		//把参数组中所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
		$request_data = createLinkstringUrlencode($para);
		
		return $request_data;
	}
	
    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @param $method 提交方式。两个值可选：post、get
     * @param $button_name 确认按钮显示文字
     * @return 提交表单HTML文本
     */
	function buildRequestForm($para_temp, $method, $button_name) {
		//待请求参数数组
		$para = $this->buildRequestPara($para_temp);
		
		$sHtml = "<form id='alipayresponse' name='alipayresponse' action='".$this->order_array['return_url']."' method='".$method."'>";
		while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

		//submit按钮控件请不要含有name属性
    $sHtml = $sHtml."<input type='submit'  value='".$button_name."'></form>";
// 		$sHtml = $sHtml."<script>document.forms['alipayresponse'].submit();</script>";
		
		return $sHtml;
	}
	
	/**
     * 建立请求，以模拟远程HTTP的POST请求方式构造并获取支付宝的处理结果
     * @param $para_temp 请求参数数组
     * @return 支付宝处理结果
     */
	function buildRequestHttp($para_temp) {
		$sResult = '';
		
		//待请求参数数组字符串
		$request_data = $this->buildRequestPara($para_temp);

		//远程获取数据
		$sResult = getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config['cacert'],$request_data,trim(strtolower($this->alipay_config['input_charset'])));

		return $sResult;
	}
	
	/**
     * 建立请求，以模拟远程HTTP的POST请求方式构造并获取支付宝的处理结果，带文件上传功能
     * @param $para_temp 请求参数数组
     * @param $file_para_name 文件类型的参数名
     * @param $file_name 文件完整绝对路径
     * @return 支付宝返回处理结果
     */
	function buildRequestHttpInFile($para_temp, $file_para_name, $file_name) {
		
		//待请求参数数组
		$para = $this->buildRequestPara($para_temp);
		$para[$file_para_name] = "@".$file_name;
		
		//远程获取数据
		$sResult = getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config['cacert'],$para,trim(strtolower($this->alipay_config['input_charset'])));

		return $sResult;
	}
	
	/**
     * 用于防钓鱼，调用接口query_timestamp来获取时间戳的处理函数
	 * 注意：该功能PHP5环境及以上支持，因此必须服务器、本地电脑中装有支持DOMDocument、SSL的PHP配置环境。建议本地调试时使用PHP开发软件
     * return 时间戳字符串
	 */
	function query_timestamp() {
		$url = $this->alipay_gateway_new."service=query_timestamp&partner=".trim(strtolower($this->alipay_config['partner']))."&_input_charset=".trim(strtolower($this->alipay_config['input_charset']));
		$encrypt_key = "";		

		$doc = new DOMDocument();
		$doc->load($url);
		$itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
		$encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
		
		return $encrypt_key;
	}

	/**
	 * 生成随机字符串
	 * 
	 * @param $length 指定的长度
	 * @return 字符串
	 */
	public function getRandChar($length){
	  $str = null;
	  $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	  $max = strlen($strPol)-1;
	
	  for($i=0;$i<$length;$i++){
	    $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	  }
    return $str;
	}
	
	

	/**
	 * 构造异步通知参数
	 *
	 * @return array 异步通知参数
	 */
	function buildNoticePara($notify_type, $action){
	
	  $noticeArray = array(
	      //响应ID
	      'notify_id' => $this->notify_id,
	
	      //订单ID
	      'order_id' => $this->order_array['ali_order_id'],
	
	      //响应类型，trade_status_sync(同步return)和trade_status_async(异步notify)
	      'notify_type' => $notify_type,
	
	      //处理动作
	      'notify_info' => $action,
	
	      //是否通知到，此处为0，未通知到
	      'is_success' => 0,
	
	      //响应发送时间
	      'notify_send_time'	=> date("Y-m-d H:i:s"),
	
	  );
	  
	  //debug
	  print_r($noticeArray);
	  
	  return $noticeArray;
	
	}
	
	
	/**
	 * 构造同步通知参数
	 * 
	 * @return 同步通知参数
	 */
  function buildReturnArray($is_success = 'T'){
    $returnArray = array(
        //基本参数
        'is_success' => $is_success,
        'partnerID' => $this->order_array['partner'],
        'sign_type' => $this->order_array['sign_type'],
        
        //业务参数
        'notify_id' => $this->notify_id,
        'notify_type' => 'trade_status_sync',//通知类型
        'notify_time' => date("Y-m-d H:i:s"),
        'trade_no' => $this->order_array['ali_order_id'],
        'subject'	=> $this->order_array['subject'],
        'price'	=> $this->order_array['price'],
        'quantity'	=> $this->order_array['quantity'],
        'seller_email' => $this->order_array['seller_email'],
        'buyer_email' => $this->order_array['buyer_email'],
        'seller_id' => $this->order_array['partner'],
        'buyer_id' => $this->order_array['buyer_id'],
        'discount' => 0,//商品折扣
        'total_fee' => $this->order_array['price'],
        //'trade_status' => '',//交易状态
        'is_total_fee_adjust' => 'N',//总价是否调整过
        'use_coupon' => 'N',//是否使用红包
        'out_trade_no' => $this->order_array['out_trade_no'],
        'body'	=> $this->order_array['body'],
        'payment_type'	=> $this->order_array['payment_type'],
        'logistics_type'	=> $this->order_array['logistics_type'],
        'logistics_fee'	=> $this->order_array['logistics_fee'],
        'logistics_payment'	=> $this->order_array['logistics_payment'],
        'receive_name'	=> $this->order_array['receive_name'],
        'receive_address'	=> $this->order_array['receive_address'],
        'receive_zip'	=> $this->order_array['receive_zip'],
        'receive_phone'	=> $this->order_array['receive_phone'],
        'receive_mobile'	=> $this->order_array['receive_mobile'],
        
    );
    
    //debug
    //print_r($returnArray);exit;
    
    return $returnArray;
  }


  
  /**
   * 构造异步通知参数
   *
   * @return 异步通知参数
   */
  function buildNotifyArray($is_success = 'T'){
    $notifyArray = array(
        //基本参数
        'is_success' => $is_success,
        'partnerID' => $this->order_array['partner'],
        'sign_type' => $this->order_array['sign_type'],
  
        //业务参数
        'notify_id' => $this->notify_id,
        'notify_type' => 'trade_status_sync',//通知类型
        'notify_time' => date("Y-m-d H:i:s"),
        'trade_no' => $this->order_array['ali_order_id'],
        'subject'	=> $this->order_array['subject'],
        'price'	=> $this->order_array['price'],
        'quantity'	=> $this->order_array['quantity'],
        'seller_email' => $this->order_array['seller_email'],
        'buyer_email' => $this->order_array['buyer_email'],
        'seller_id' => $this->order_array['partner'],
        'buyer_id' => $this->order_array['buyer_id'],
        'discount' => 0,//商品折扣
        'total_fee' => $this->order_array['price'],
        'is_total_fee_adjust' => 'N',//总价是否调整过
        'use_coupon' => 'N',//是否使用红包
        'out_trade_no' => $this->order_array['out_trade_no'],
        'body'	=> $this->order_array['body'],
        'payment_type'	=> $this->order_array['payment_type'],
        'logistics_type'	=> $this->order_array['logistics_type'],
        'logistics_fee'	=> $this->order_array['logistics_fee'],
        'logistics_payment'	=> $this->order_array['logistics_payment'],
        'receive_name'	=> $this->order_array['receive_name'],
        'receive_address'	=> $this->order_array['receive_address'],
        'receive_zip'	=> $this->order_array['receive_zip'],
        'receive_phone'	=> $this->order_array['receive_phone'],
        'receive_mobile'	=> $this->order_array['receive_mobile'],
  
    );
  
    return $notifyArray;
  }
  
  
  /**
   * 补全响应参数数组中的trade_status成员
   * 
   * @param unknown_type $noticeArray
   * @param unknown_type $action
   * @return string
   */
  function buildTradeStatusPara($noticeArray, $action){
    //根据action决定trade_status的值
    switch ($action) {
      //※ 买家支付动作,WAIT_BUYER_PAY-->WAIT_SELLER_SEND_GOODS
      case 'BUYER_PAY_FOR_ORDER' :
        $noticeArray['trade_status'] = 'WAIT_SELLER_SEND_GOODS';
        break;
    
        //卖家发货动作,WAIT_SELLER_SEND_GOODS-->WAIT_BUYER_CONFIRM_GOODS
      case 'SELLER_SEND_GOOD' :
        $noticeArray['trade_status'] = 'WAIT_BUYER_CONFIRM_GOODS';
        break;
    
        //※买家收货动作,WAIT_BUYER_CONFIRM_GOODS-->TRADE_FINISHED
      case 'BUYER_CONFIRM_GOODS' :
        $noticeArray['trade_status'] = 'TRADE_FINISHED';
        break;
    
        //买家提出退货请求并发货,WAIT_BUYER_CONFIRM_GOODS-->WAIT_SELLER_CONFIRM_GOODS
      case 'BUYER_SEND_GOOD' :
        $noticeArray['trade_status'] = 'WAIT_SELLER_CONFIRM_GOODS';
        break;
    
        //买家退货并发货后,卖家收货动作,WAIT_BUYER_CONFIRM_GOODS-->TRADE_CANCEL_SUCCESS
      case 'SELLER_CONFIRM_GOODS' :
        $noticeArray['trade_status'] = 'TRADE_CANCEL_SUCCESS';
        break;
    
        //买家未付款买家取消订单,WAIT_BUYER_PAY-->CANCEL_BY_BUYER_BEFORE_PAY
      case 'CANCEL_BY_BUYER_BEFORE_PAY' :
        $noticeArray['trade_status'] = 'CANCEL_BY_BUYER_BEFORE_PAY';
        break;
    
        //买家未付款卖家取消订单,WAIT_BUYER_PAY-->CANCEL_BY_SELLER_BEFORE_PAY
      case 'CANCEL_BY_SELLER_BEFORE_PAY' :
        $noticeArray['trade_status'] = 'CANCEL_BY_SELLER_BEFORE_PAY';
        break;
    
        //买家付款后,卖家发货前,取消订单,WAIT_SELLER_SEND_GOODS-->TRADE_CANCEL_SUCCESS
      case 'CANCEL_AFTER_PAY_BEFORE_SEND' :
        $noticeArray['trade_status'] = 'TRADE_CANCEL_SUCCESS';
        break;
    
        //卖家发货后买家取消订单等待买家发货,WAIT_BUYER_CONFIRM_GOODS-->WAIT_SELLER_CONFIRM_GOODS
      case 'CANCEL_AFTER_SEND' :
        $noticeArray['trade_status'] = 'WAIT_SELLER_CONFIRM_GOODS';
        break;
    
    
      default :
        $noticeArray['trade_status'] = 'ERROR_TRADE_STATUS';
    }
    
    //debug
    print_r($noticeArray);//exit;
    
    return $noticeArray;
    
  }
  
}


?>