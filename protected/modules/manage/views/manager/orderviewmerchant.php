<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>订单明细</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet">
        <link href="<?php echo MANAGE_CSS_URL; ?>gridview/styles.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：用户管理-》订单信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo MANAGE;?>manager/showuser">【返回】</a>
                </span>
            </span>
        </div>   
        <div style="font-size: 13px;margin: 10px 5px">
        <!-- <table broder="1" width="60%" class="table_a"> -->
        <?php $form = $this ->beginWidget('CActiveForm', array('method'=>'get', 'action'=>MANAGE.'manager/orderviewmerchant')); ?>
        <table broder="1" >
			<tr>
				<td>起止日期：</td>
				<td>
				<?php 
    				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								//'attribute'=>'user_birth',
								'language'=>'zh_cn',											
         						//'model'=>$user_info,
         						'name'=>'start_date',
         						'value'=>date('Y-m-d',mktime(0,0,0, date('m')-1,date('d'),date('Y'))),
								'options'=>array(
									'showAnim'=>'slideDown',
									'showOn'=>'both',
									'changeMonth'=>true,
									'changeYear'=>true,
									'dateFormat'=>'yy-mm-dd',
									'yearRange'=>'2000:',
									'minDate' => '2000-01-01',
									'maxDate' => date('y-d-m'),
									),
								'htmlOptions'=>array(
									'class'=>'tb_input',
									),
								)
         					);
         				?>
         		<?php 
         			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								//'attribute'=>'user_birth',
								'language'=>'zh_cn',											
         						//'model'=>$user_info,
         						'name'=>'end_date',
         						'value'=>date('Y-m-d'),
								'options'=>array(
									'showAnim'=>'slideDown',
									'showOn'=>'both',
									'changeMonth'=>true,
									'changeYear'=>true,
									'dateFormat'=>'yy-mm-dd',
									'yearRange'=>'2000:',
									'minDate' => '2000-01-01',
									'maxDate' => date('y-d-m'),
								),
								'htmlOptions'=>array(
									'class'=>'tb_input',
								),
							)
         				);
         			?>
         			<input type=hidden name="order_id" value=<?php echo $order_id ?>>
         		</td>				
				<td >
                    <?php echo CHtml::submitButton('查询',array('class'=>'but_confirm')); ?>
                </td>           
             <?php $this -> endwidget(); ?>                     	
				<td>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=date_today&id=<?php echo $order_id ?>" target="_self">今天</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=date_month_one&id=<?php echo $order_id ?>" target="_self">最近1个月</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=date_month_three&id=<?php echo $order_id ?>" target="_self">3个月</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=date_year_one&id=<?php echo $order_id ?>" target="_self">1年</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=date_year_before&id=<?php echo $order_id ?>" target="_self">1年前>></a>
				</td>
			</tr>
			<tr>
				<td>交易状态：</td>
				<td>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_processing&id=<?php echo $order_id ?>" target="_self">进行中</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_pay_no&id=<?php echo $order_id ?>" target="_self">未付款</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_waiting&id=<?php echo $order_id ?>" target="_self">等待发货</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_receipt_no&id=<?php echo $order_id ?>" target="_self">未确认收货</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_success&id=<?php echo $order_id ?>" target="_self">交易成功</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=trade_failure&id=<?php echo $order_id ?>" target="_self">交易失败</a>
					<a class=menuchild href="<?php echo MANAGE;?>manager/orderviewmerchant?type=all&id=<?php echo $order_id ?>" target="_self">全部</a>
				</td>			
			</tr>			
        </table>        
        </div>
        <div >
	        <table   width="100%">
		        <tr>
		 			<td>创建时间</td>
		 			<td>名称|交易号</td>
		 			<td>收货方|用户名</td>  
		 			<td>金额|明细</td>     
		        	<td>状态</td>
		        	<td>操作</td>
		        </tr>
		        <?php if ($order_infos){foreach($order_infos as $_v){?>
		        <tr>
		        	<td><?php echo $_v['order_add_time'] ?> </td>		        	
		        	<td><?php echo $_v['subject'] ?><br>交易号：<?php echo $_v['out_trade_no']?></td>
		        	<td><?php echo $_v['buyer_email'] ?><br>用户名：<?php echo $_v['user_name']?> </td>
		        	<td><?php echo $_v['price'] ?> </td>
		        	<td><?php echo $_v['status_info'] ?> </td>
		        	<td><?php echo $_v['status_id'] ?> </td>	        	 		       	
		        </tr>
		        <?php }}?>
		        <tr>
		        	<td colspan="20" style="text-align: center;">
		        		<?php echo $page_list; ?>        		
		        	</td>
		        </tr>
	        </table>
        </div>
    </body>
</html>