<?php

echo TbHtml::lead('交易量排名前五位');
$this->widget('bootstrap.widgets.TbGridView', array(
			'dataProvider' => $countdataProvider,
			'template' => "{items}",
			'columns' => array(
					array(
							'name' => 'buyer_id',
							'header' => '买家id',
					),
					array(
							'name' => 'receive_name',
							'header' => '买家名',
					),
					array(
							'name' => 'receive_mobile',
							'header' => '买家手机',
					),
					array(
							'name' => 'total',
							'header' => '订单量',
					),
					array(
							'name' => 'buyer_email',
							'header' => '买家邮箱',
					),
					
			),
		)
	);
// echo "<pre>";
// var_dump($countdataProvider);
// echo "</pre>";
?>
<!-- </div> -->
<!-- <table  valign=center border=0 cellspacing=10 > -->
<!-- 	<tr> -->
<!-- 		<td width=100 height=50>客户id</td> -->
<!-- 		<td width=100>客户名</td> -->
<!-- 		<td width=100>客户手机</td> -->
<!-- 		<td width=100>订单量</td> -->
<!-- 		<td width=100>客户邮箱</td> -->
<!-- 	</tr> -->
 <?php 
// 	for($index=0;$index<sizeof($id);$index++)
// 	{

// 		echo "<tr>";
// 		echo "<td width=100 height=50>$id[$index]</td>";
// 		echo "<td width=100>$name[$index]</td>";
// 		echo "<td width=100>$mobile[$index]</td>";
// 		echo "<td width=100>$price[$index]</td>";
// 		echo "<td width=100>$email[$index]</td>";
// 		echo "</tr>";
// 	}
// ?>
</table>