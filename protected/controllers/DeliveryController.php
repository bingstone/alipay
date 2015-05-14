<?php

class DeliveryController extends Controller{
	
  
  public function actionRec(){
  
   $RecArray = array();
    if(!empty($_GET))
      $RecArray = $_GET;
    elseif (!empty($_POST))
      $RecArray = $_POST;
    else 
      $RecArray = '';
    
    $fp = fopen("curl.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,'时间：'.date('Y-m-d H:i:s',time())."\t内容：".json_encode($RecArray)."\n");
    flock($fp, LOCK_UN);
    fclose($fp);

    //取得商户信息
    $merchant_info = Yii::app()->
                      db->
                      createCommand()->
                      from('{{MERCHANT}}')->
                      where('merchant_id = :merchant_id',array('merchant_id'=>$RecArray['partner']))->
                      queryRow();
    
    if(!empty($merchant_info)) {
      //除去数组中的空值和签名参数
      $para_filter = array();
      while (list ($key, $val) = each ($RecArray)) {
        if($key == "sign" || $key == "sign_type" || $val == "")continue;
        else	$para_filter[$key] = $RecArray[$key];
      }
      
      //对数组排序
      ksort($para_filter);
      reset($para_filter);

      //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
      $prestr = createLinkstring($para_filter);
      //echo $prestr;exit;

      //生成签名
      $mysign = md5Sign($prestr, $merchant_info['key_value']);
      
      //对比新旧签名值
      if($mysign == $RecArray['sign']){
        
        $order_model = Order::model();
        $transaction = $order_model->dbConnection->beginTransaction();
        try {
          $order_model->updateByPk($RecArray['trade_no'], array('status_id'=>6, 'logistics_no'=>$RecArray['invoice_no'], 'order_send_time'=>date('Y-m-d H:i:s'), ));
        }catch(Exception $e){
          $transaction->rollBack();
          echo 'Ifalse';//插入失败。回滚操作
        }
        echo 'success';
      }
      else{
        echo 'Sfalse';//签名验证失败的标识
      }
    }
    //若查询不到此商户信息
    else 
      echo 'Mfalse';//商户不正确的标识
    
  }
  
	public function actionrecl(){
		
		echo 'holle1234531234';
	}
	
	public function actioncurl(){
		//$url = 'http://10.10.108.201/Alipay_yii/index.php/delivery/recl';
		$url = 'http://10.10.108.201/Alipay_yii/index.php/delivery/recl';
		$curl = curl_init( $url );
		$data = curl_exec($curl);
		curl_close($curl);
		var_dump($data);
	}

}