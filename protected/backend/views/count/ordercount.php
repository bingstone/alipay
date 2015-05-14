<?php
$this->breadcrumbs = array(
		'管理员信息'=>array('/index/index'),
		'订单数据统计',
);
$this->widget('bootstrap.widgets.TbNav', array(
		'type' => TbHtml::NAV_TYPE_TABS,
		'items' => array(
				array('label' => '首页', 'url' => ADMIN.'count/ordercount', 'active' => $if_show[0]),
				array('label' => '添加订单统计', 'url' => ADMIN.'count/ordercount/type/order', 'active' => $if_show[1]),
				array('label' => '资金统计', 'url' => ADMIN.'count/ordercount/type/finance', 'active' => $if_show[2]),
				array('label' => '交易统计', 'url' => ADMIN.'count/ordercount/type/trade', 'active' => $if_show[3]),
		),
)
);
if ($if_show[1]){
	$this->renderPartial('_order_order', array('total'=>$total, 'data'=>$data, 'date'=>$date,));
} else if ($if_show[2]) {
	$this->renderPartial('_order_finance', array('total'=>$total, 'total_price'=>$total_price, 'monthly_price_success'=>$monthly_price_success, 'monthly_price'=>$monthly_price, 'monthly_price_pending'=>$monthly_price_pending, 'date'=>$date,));
} else if ($if_show[3]) {
	$this->renderPartial('_order_trade', array('total'=>$total, 'countdataProvider'=>$countdataProvider,'data'=>$data, 'data_success'=>$data_success, 'data_pending'=>$data_pending, 'date'=>$date, ));
} else {
	$this->renderPartial('_order_index');
}
?>