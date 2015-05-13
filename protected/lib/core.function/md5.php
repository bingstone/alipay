<?php
/*****************************************************************************
 * 
 * @charset UTF-8
 * @author wulin
 * @time 2014-10-21
 *****************************************************************************/
 
/**
 * 签名字符串
 * @param $prestr 需要签名的字符串
 * @param $key 私钥
 * return 签名结果
 */
function md5Sign($prestr, $key)
{
  $prestr = $prestr . $key;
  return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key){
  $prestr = $prestr . $key;
  $mysgin = md5($prestr);

//  echo '</br>'.'mysign:'.$mysgin.'---'.'sign:'.$sign.'----'.$key.'</br>';
//  echo '</br>'.$prestr.'</br>';
  
  if($mysgin == $sign){
    return true;
  }
  else{
    return false;
  }
}

?>