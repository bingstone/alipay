<?php
echo TbHtml::well('<p>总账户余额为<b>'.$total_balance.'</b>元。</p>', array('size' => TbHtml::WELL_SIZE_SMALL));
?>
<div>
<?php
foreach ($balance_data as $_k => $_v){
	$arry[$_k] =(int)$_v;
}
$hold_balance = array('0', '<50', '<100', '<200', '<500', '<1000', '<2000', '<5000', '<10000', '<50000', '<100000', '100000>',);
$this->widget(
		'yiiwheels.widgets.highcharts.WhHighCharts',
		array(
				'pluginOptions' => array(
						'chart' => array('type' => 'column'),
						'title' => array('text' => '商户持有资金分布'),
						'xAxis' => array(
								'title' => array('text' => '资金范围'),
								'categories' => $hold_balance,
						),
						'yAxis' => array(
								'title' => array('text' => '商户数量'),
						),
						'series' => array(
								array('name' => '商户数', 'data' => $arry),						
						)
				)
		)
);
?>
</div>