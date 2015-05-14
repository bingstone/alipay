<?php
foreach ($data as $_k => $_v){
	$arry[$_k] =(int)$_v;
}
echo TbHtml::well('<p>总共注册人数为<b>'.$total.'</b>。本月注册人数为<b>'.$arry[0].'</b></p>', array('size' => TbHtml::WELL_SIZE_SMALL));
$this->widget(
		'yiiwheels.widgets.highcharts.WhHighCharts',
		array(
				'pluginOptions' => array(
						'title' => array('text' => '12月内注册用户数据统计'),
						'xAxis' => array(
								'title' => array('text' => '年—月'),
								'categories' => array_reverse($date),
						),
						'yAxis' => array(
								'title' => array('text' => '注册用户数')
						),
						'series' => array(
								array('name' => '用户数', 'data' => array_reverse($arry), ),
						)
				)
		)
);
?>