<?php
$this->breadcrumbs = array(
		'管理员信息'=>array('/index/index'),
		'商户数据统计',
);
$this->widget('bootstrap.widgets.TbNav', array(
		    	'type' => TbHtml::NAV_TYPE_TABS,
		    	'items' => array(
		    			array('label' => '首页', 'url' => ADMIN.'count/merchantcount', 'active' => $if_show[0]),
		    			array('label' => '注册商户统计', 'url' => ADMIN.'count/merchantcount/type/merchant', 'active' => $if_show[1]),
		    			array('label' => '资金统计', 'url' => ADMIN.'count/merchantcount/type/finance', 'active' => $if_show[2]),
		    			array('label' => '交易统计', 'url' => ADMIN.'count/merchantcount/type/trade', 'active' => $if_show[3]),
		    	),
		)
);
if ($if_show[1]){
	$this->renderPartial('_merchant_merchant', array('total'=>$total, 'data'=>$data, 'date'=>$date,));	
} else if ($if_show[2]) {
	$this->renderPartial('_merchant_finance', array('total_balance'=>$total_balance, 'total_freeze'=>$total_freeze, 'balance_data'=>$balance_data));
} else if ($if_show[3]) {
	$this->renderPartial('_merchant_trade', array('countdataProvider'=>$countdataProvider, 'trade_count'=>$trade_count, 'moneydataProvider'=>$moneydataProvider, 'trade_money'=>$trade_money ));
} else {
	$this->renderPartial('_merchant_index');
}
?>