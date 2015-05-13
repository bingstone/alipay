<?php
echo TbHtml::well('<p>总订单数<b>'.$total, array('size' => TbHtml::WELL_SIZE_SMALL));
?>
<div>
<?php
foreach ($data_success as $_k => $_v){
	$arry_success[$_k] =(int)$_v;
	
}
//Yii::log('monthly_price_here_ar='.$monthly_price);
//Yii::log('monthly_price_here='.$monthly_price[0]);



foreach ($data as $_k => $_v){
	$arry[$_k] =(int)$_v;
}

foreach ($data_pending as $_k => $_v){
	$arry_pending[$_k] =(int)$_v;
}
/*
echo 'arry_success=';
var_dump($arry_success);
echo 'arry_pending=';
var_dump($arry_pending);
echo 'arry=';
var_dump($arry);
*/

$hold_balance = array('0', '<50', '<100', '<200', '<500', '<1000', '<2000', '<5000', '<10000', '<50000', '<100000', '100000>',);
$this->widget(
		'yiiwheels.widgets.highcharts.WhHighCharts',
		array(
				'pluginOptions' => array(
						'chart' => array('type' => 'column'),
						'title' => array('text' => '订单分布'),
						'xAxis' => array(
								'title' => array('text' => '年—月'),
								'categories' => array_reverse($date),
								'crosshair' => true,
						),
						'yAxis' => array(
								'min' => 0,
								'title' => array('text' => '订单数'),
						),
						'series' => array(
								array('name' => '未完成数', 'data' => array_reverse($arry_pending)),
								array('name' => '完成数', 'data' => array_reverse($arry_success)),
								array('name' => '总订单数', 'data' => array_reverse($arry)),													
						),
						'tooltip' => array(
								'headerFormat' => '<span style="font-size:10px">{point.key}</span><table>',
								'pointFormat' => '<tr><td style="color:{series.color};padding:0">{series.name}: </td>'.'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
								'footerFormat' => '</table>',
								'shared' => true,
								'useHTML' => true,					
						),
						'plotOptions' => array(
								'column' => array(
									'pointPadding' => 0.2,
									'borderWidth' => 0,
								),								
						)
						
				)
		)
);
?>
</div>