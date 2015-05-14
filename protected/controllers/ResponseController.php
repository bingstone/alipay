<?php

class ResponseController extends Controller{
	
  
  public function actionReturn(){
    
    $order_id = $_GET['id'];
    $action = $_GET['action'];

    $return_array = array();
    $resAction = new AlipayResponse($order_id);
    
    /**
     * 构造响应记录,待写到Notice数据表中
     * 
     */
    $noticePara = $resAction->buildNoticePara('trade_status_sync', $action);
    
    /**
     * @abstract 同步响应,根据action构造相应的响应参数
     * 
     * 支持状态变化动作："付款"、"取消订单(多种)"、"收货"
     * 
     */
    $return_array = $resAction->buildReturnArray('T');
    $return_array = $resAction->buildTradeStatusPara($return_array, $action);
    
    /**
     * 插入响应记录到Notice数据表中
     * 
     */
    $notice_model = new Notice();
    $notice_model -> attributes = $noticePara;
    if($notice_model -> save()){
      //进行数据响应
      $html_text = $resAction->buildRequestForm($return_array, "post", "确认");
      echo $html_text;
      
    }
    else{
      WebMessage::error('支付平台数据响应处理失败，联系技术人员',$resAction->order_array['show_url'],3);
      //Yii::app()->jump->error('支付平台数据响应处理失败，联系技术人员', $resAction->order_array['show_url']);
    }
    
/* 
    $this->render('orderShow',
        array('order_model'=>$orderRes->order_array,
        )
    );
 */    
    
  }
  
  
  /*
   * 
   */
  public function actionNotify(){
    
    $order_id = 20141225013829097;
    $action = 1;

    $notify_array = array();
    $resAction = new AlipayResponse($order_id);
    
    $noticePara = $resAction->buildNoticePara('trade_status_async', $action);
    
    /**
     * @abstract 异步响应,根据action构造相应的响应参数
     * 
     * 支持状态变化动作："付款"、"取消订单(多种)"、"收货"
     * 
     */
    $notify_array = $resAction->buildNotifyArray('T');
    $return_array = $resAction->buildTradeStatusPara($return_array, $action);
    $html_text = $resAction->buildRequestForm($return_array, "post", "确认");
    echo $html_text;
    
    //$this->redirect(array('orderinsert', 'OrderArray'=>json_encode($parameter), ));
    
	}

}
