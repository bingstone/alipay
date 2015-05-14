<?php
/*****************************************************************************
 *
* 类名：OrcderRecCheck
* 功能：订单接收类
* 详细：支付宝接收订单之后检查参数状况
* 版本：0.1
* 说明：
*
* @charset
* @author wulin
* @time 2014-10-21
*****************************************************************************/
header("Content-type: text/html; charset=utf-8");
class OrderReceive{

  // HTTPS形式消息验证地址
  //var $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';
  //HTTP形式消息验证地址
  //var $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
  /**
   * @var 订单参数数组
   */
  var $order_array;

  /**
   * @var 卖家身份信息(DB中读取)
   */
  var $merchant_info;
  
  /**
   * 订单检查类解析函数
   * @param 配置数组  $order_array
   */
  function __construct($order_array){
    $this->order_array = $order_array;
    $this->merchant_info = Yii::app()->
                            db->
                            createCommand()->
                            from('ALI_MERCHANT')->
                            where('merchant_id = :merchant_id',array('merchant_id'=>$this->order_array['partner']))->
                            queryRow();
//    echo '</br>----'.$this->order_array['partner'].'----</br>';
//     echo '</br>----'.print_r($this->merchant_info).'----</br>';
//     echo '</br>----'.$this->merchant_info['merchant_email'].'----</br>';
  }

  function OrderRecCheck($order_array){
    $this->__construct($order_array);
  }

  /**
   * 针对订单参数中的商户id和KEY，进行商户身份验证
   * @return array 商户信息
   */
  function verifyMerchant(){
    if(empty($_GET)){	//判断GET来的数组是否为空
      return array();
    }
    else{
//      echo '</br>ssss'.$this->merchant_info['partner'].'</br>===={'.print_r($this->merchant_info).'}====</br>';
//       echo '</br>'.empty($row).'</br>';
      return $this->merchant_info;
    }
  }

  /**
   * 针对此卖家的KEY验证订单消息是否是合法消息
   * @return boolean 验证结果
   */
  function verifyOrder(){
    if(empty($_GET)){	//判断GET来的数组是否为空
      return false;
    }
    else{
      //生成签名结果
      //echo 'myKey:'.'</br>'.$this->merchant_info['key_value'].'</br>';
      //echo 'partner:'.'</br>'.$this->order_array['partner'].'</br>';
      //echo 'partner:'.'</br>'.print_r($this->merchant_info).'</br>';
      $isSign = $this->getSignVeryfy($this->order_array, $this->order_array['sign'], $this->merchant_info['key_value']);
      //获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
      $responseTxt = 'true';
      
      //写日志记录
      if ($isSign){
        $isSignStr = 'true';
      }
      else{
        $isSignStr = 'false';
      }
      $log_text = "responseTxt=".$responseTxt."\n notify_url_log:isSign=".$isSignStr.",";
      $log_text = $log_text.createLinkString($_POST);
      logResult($log_text);
       
       
      //验证
      //$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
      //isSign的结果不是true，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
      if (preg_match("/true$/i",$responseTxt) && $isSign){
        return true;
      }
      else{
        return false;
      }
    }
  }

  /**
   * 获取返回时的签名验证结果
   * @param $para_temp 通知返回来的参数数组
   * @param $sign 返回的签名结果
   * @return 签名验证结果
   */
  /**
   *
   * @param unknown_type $para_temp
   * @param unknown_type $sign
   * @return boolean
   */
  function getSignVeryfy($para_temp, $sign, $key){
    //除去待签名参数数组中的空值和签名参数
    $para_filter = paraFilter($para_temp);

    //对待签名参数数组排序
    $para_sort = argSort($para_filter);
    
    
    //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
    $prestr = createLinkstring($para_sort);

/*
 * 默认使用MD5进行加密，后期可以进行扩展
 */
    $isSgin = false;
    switch (strtoupper(trim($this->order_array['sign_type']))){
      case "MD5" :
        $isSgin = md5Verify($prestr, $sign, $key);
        break;
      default :
        $isSgin = false;
    }
   // $isSgin = md5Verify($prestr, $sign, $this->merchant_info['key_value']);

    return $isSgin;
  }
  

  /**
   * 针对return_url验证消息是否是支付宝发出的合法消息
   * @return 验证结果
   */
  function verifyReturn(){
    if(empty($_GET))
    {//判断POST来的数组是否为空
      return false;
    }
    else{
      //生成签名结果
      $isSign = $this->getSignVeryfy($_GET, $_GET["sign"]);
  
      //获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
      $responseTxt = 'true';
      if (! empty($_GET["notify_id"])) {
        $responseTxt = $this->getResponse($_GET["notify_id"]);
      }
       
       
      //写日志记录
      if ($isSign){
        $isSignStr = 'true';
      }
      else{
        $isSignStr = 'false';
      }
      $log_text = "responseTxt=".$responseTxt."\n return_url_log:isSign=".$isSignStr.",";
      $log_text = $log_text.createLinkString($_GET);
      logResult($log_text);
       
       
      //验证
      //$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
      //isSign的结果不是true，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
      //preg_match函数执行全局正则表达式匹配
      if (preg_match("/true$/i",$responseTxt) && $isSign){
        return true;
      }
      else{
        return false;
      }
    }
  }
  
  
  /*************************以下function暂未用到*****************************/
  
  /**
   * 获取远程服务器ATN结果,验证返回URL
   * @param $notify_id 通知校验ID
   * @return 服务器ATN结果
   * 验证结果集：
   * invalid命令参数不对 出现这个错误，请检测返回处理中partner和key是否为空
   * true 返回正确信息
   * false 请检查防火墙或者是服务器阻止端口问题以及验证时间是否超过一分钟
   */
  function getResponse($notify_id){
    $transport = strtolower(trim($this->check_config['transport']));
    $partner = trim($this->check_config['partner']);
    $veryfy_url = '';
    if($transport == 'https')
    {
      $veryfy_url = $this->https_verify_url;
    }
    else{
      $veryfy_url = $this->http_verify_url;
    }
    $veryfy_url = $veryfy_url."partner=" . $partner . "&notify_id=" . $notify_id;
    $responseTxt = getHttpResponseGET($veryfy_url, $this->check_config['cacert']);

    return $responseTxt;
  }
}
?>