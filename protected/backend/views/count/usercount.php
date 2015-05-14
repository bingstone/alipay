<?php
$this->breadcrumbs = array(
		'管理员信息'=>array('/index/index'),
		'用户数据统计',
);
$this->widget('bootstrap.widgets.TbNav', array(
		    	'type' => TbHtml::NAV_TYPE_TABS,
		    	'items' => array(
		    			array('label' => '首页', 'url' => ADMIN.'count/usercount', 'active' => $if_show[0]),
		    			array('label' => '注册用户统计', 'url' => ADMIN.'count/usercount/type/user', 'active' => $if_show[1]),
		    			array('label' => '资金统计', 'url' => ADMIN.'count/usercount/type/finance', 'active' => $if_show[2]),
		    			array('label' => '交易统计', 'url' => ADMIN.'count/usercount/type/trade', 'active' => $if_show[3]),
		    	),
		)
);
if ($if_show[1]){
	$this->renderPartial('_user_user', array('total'=>$total, 'data'=>$data, 'date'=>$date,));	
} else if ($if_show[2]) {
	$this->renderPartial('_user_finance', array('total_balance'=>$total_balance, 'total_freeze'=>$total_freeze, 'balance_data'=>$balance_data));
} else if ($if_show[3]) {
	$this->renderPartial('_user_trade', array('countdataProvider'=>$countdataProvider, 'trade_count'=>$trade_count, 'moneydataProvider'=>$moneydataProvider, 'trade_money'=>$trade_money ));
} else {
	$this->renderPartial('_user_index');
}
?>