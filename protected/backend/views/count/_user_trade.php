<?php
echo TbHtml::lead('交易量排名前五位');
$this->widget('bootstrap.widgets.TbGridView', array(
			'dataProvider' => $countdataProvider,
			'template' => "{items}",
			'columns' => array(
					array(
							'name' => 'user_id',
							'header' => '用户id',
					),
					array(
							'name' => 'user_name',
							'header' => '用户名',
					),
					array(
							'name' => 'user_phone',
							'header' => '手机号码',
					),
					array(
							'name' => 'ali_email',
							'header' => '电子邮箱',
					),
					array(
							'name' => 'trade_count',
							'header' => '交易量',
					),
					array(
							'name' => 'user_country',
							'header' => '所属国家',
					),
					array(
							'name' => 'user_addtime',
							'header' => '注册时间',
					),
			),
		)
	);
foreach ($trade_count as $_k => $_v){
	$arry[$_k] =(int)$_v;
}
$hold_count = array('0', '5<', '10<', '20<', '50<', '100<', '150<', '300<', '600<', '1000<', '2000<', '5000<', '10000<', '50000<', '100000<', '100000>',);
$this->widget(
		'yiiwheels.widgets.highcharts.WhHighCharts',
		array(
				'pluginOptions' => array(
						'chart' => array('type' => 'column'),
						'title' => array('text' => '用户交易量分布'),
						'xAxis' => array(
								'title' => array('text' => '交易量'),
								'categories' => $hold_count,
						),
						'yAxis' => array(
								'title' => array('text' => '用户数量'),
						),
						'series' => array(
								array('name' => '用户数', 'data' => $arry),
						)
				)
		)
);
echo TbHtml::lead('交易额排名前五位');
$this->widget('bootstrap.widgets.TbGridView', array(
		'dataProvider' => $moneydataProvider,
		'template' => "{items}",
		'columns' => array(
				array(
						'name' => 'user_id',
						'header' => '用户id',
				),
				array(
						'name' => 'user_name',
						'header' => '用户名',
				),
				array(
						'name' => 'user_phone',
						'header' => '手机号码',
				),
				array(
						'name' => 'ali_email',
						'header' => '电子邮箱',
				),
				array(
						'name' => 'trade_money',
						'header' => '交易额',
				),
				array(
						'name' => 'user_country',
						'header' => '所属国家',
				),
				array(
						'name' => 'user_addtime',
						'header' => '注册时间',
				),
		),
)
);
foreach ($trade_money as $_k => $_v){
	$arrys[$_k] =(int)$_v;
}
$hold_money = array('0', '100<', '500<', '1000<', '3000<', '6000<', '10000<', '15000<', '20000<', '50000<', '100000<', '500000<', '1000000<', '1000000>',);
$this->widget(
		'yiiwheels.widgets.highcharts.WhHighCharts',
		array(
				'pluginOptions' => array(
						'chart' => array('type' => 'column'),
						'title' => array('text' => '用户交易量分布'),
						'xAxis' => array(
								'title' => array('text' => '交易量'),
								'categories' => $hold_money,
						),
						'yAxis' => array(
								'title' => array('text' => '用户数量'),
						),
						'series' => array(
								array('name' => '用户数', 'data' => $arrys),
						)
				)
		)
);
?>