<?php
class NotifyController extends Controller{

	public $layout = '//layouts/column2';
	
	function actionSync(){
		//$sql = 'select *, count( distinct order_id ,notify_info ) from {{NOTICE}} where is_success = 0  group by order_id, notify_info';
		//$result = Yii::app()->db->createCommand($sql)->query();
		//print_r($result);
		//echo $result->notify_id;
		/* $result = Yii::app()->db->createCommand()
		->select('order_id, notify_type, notify_info, count(distinct order_id ,notify_info)')
		->from('{{NOTICE}}')
		->where('is_success = 0')
		->group('order_id, notify_info')
		->queryAll (); */
		$criteria = new CDbCriteria();
		//$criteria->with = '';
		$criteria->select = 'order_id, notify_type, notify_info, notify_receive_time, count(distinct order_id ,notify_info)';		
		$criteria->group = 'order_id, notify_info';
		//$criteria->order = 'notify_send_time DESC';
		$criteria->addCondition('is_success = 0');
		$dataProvider = new CActiveDataProvider('Notice',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>5
				),
		));
	    $this->render('sync',array(
    		'dataProvider' => $dataProvider,));
	}
}
?>