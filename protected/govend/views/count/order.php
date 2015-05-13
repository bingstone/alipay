<?php
$this->breadcrumbs = array(
		'管理员信息'=>array('/index/index'),
		'订单数据统计',
);
$this->widget('bootstrap.widgets.TbNav', array(
		    	'type' => TbHtml::NAV_TYPE_TABS,
		    	'items' => array(
		    			array('label' => '首页', 'url' => MERCHANT.'count/ordercount', 'active' => $if_show[0]),
		    			array('label' => '订单统计', 'url' => MERCHANT.'count/ordercount/type/merchant', 'active' => $if_show[1]),
		    			array('label' => '明细统计', 'url' => MERCHANT.'count/ordercount/type/finance', 'active' => $if_show[2]),
		    			array('label' => '数量统计', 'url' => MERCHANT.'count/ordercount/type/trade', 'active' => $if_show[3]),
		    	),
		)
);
if ($if_show[1]){
	$this->renderPartial('_order_merchant', array('total'=>$total, 'data'=>$data, 'date'=>$date,));	
} else if ($if_show[2]) {
	$this->renderPartial('_order_finance', array('total'=>$total, 'total_price'=>$total_price, 'monthly_price_success'=>$monthly_price_success, 'monthly_price'=>$monthly_price, 'monthly_price_pending'=>$monthly_price_pending, 'date'=>$date,));
} else if ($if_show[3]) {
	$this->renderPartial('_order_trade', array('if_show'=>$if_show, 'countdataProvider'=>$countdataProvider,'id'=>$id,'name'=>$name,'mobile'=>$mobile,'price'=>$price,'email'=>$email,));
} else {
	$this->renderPartial('_order_index');
}
?>