<?php 
	$this->breadcrumbs = array(
				'管理员信息' => array('/index/index'),
				'查看用户' => array('/manager/showuser'),
				'查看订单'
			);
?>

<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE,
		Yii::app()->createUrl($this->route),
		'get'); ?>
	起止日期：
    <div class="input-append">
	    <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
				'name' => 'start_date',
	    		'value'=> '',	    		
				'pluginOptions' => array(
				  	'format' => 'yyyy-mm-dd'
			    ),
	    		'htmlOptions' => array(
	    			'style'=>'width:80px; hight:20px'
	    		),
		    ));
	    ?>
	    <span class="add-on"><icon class="icon-calendar"></icon></span>
    </div>
    —
    <div class="input-append">
	    <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
			    'name' => 'end_date',
	    		'value'=> '',
			    'pluginOptions' => array(
			    	'format' => 'yyyy-mm-dd'
			    ),
	    		'htmlOptions' => array(
	    				'style'=>'width:80px; hight:20px'
	    		),
		    ));
	    ?>
	    <span class="add-on"><icon class="icon-calendar"></icon></span>
    </div>
    <input type=hidden name="order_id" value=<?php echo $order_id; ?>>
    <?php echo TbHtml::submitButton('搜索'); ?>
    &nbsp
    <a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=date_today&id=<?php echo $order_id ?>" target="_self">今天</a>    
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=date_month_one&id=<?php echo $order_id ?>" target="_self">最近1个月</a>
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=date_month_three&id=<?php echo $order_id ?>" target="_self">3个月</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=date_year_one&id=<?php echo $order_id ?>" target="_self">1年</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=date_year_before&id=<?php echo $order_id ?>" target="_self">1年前>></a>
    <?php echo TbHtml::endForm(); ?>
    <?php echo TbHtml::b('交易状态：');?>
    &nbsp
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_processing&id=<?php echo $order_id ?>" target="_self">进行中</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_pay_no&id=<?php echo $order_id ?>" target="_self">未付款</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_waiting&id=<?php echo $order_id ?>" target="_self">等待发货</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_receipt_no&id=<?php echo $order_id ?>" target="_self">未确认收货</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_success&id=<?php echo $order_id ?>" target="_self">交易成功</a>	
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=trade_failure&id=<?php echo $order_id ?>" target="_self">交易失败</a>
	<a class=menuchild href="<?php echo ADMIN;?>manager/orderviewuser?type=all&id=<?php echo $order_id ?>" target="_self">全部</a>
<br/><br/>
 <table  width="100%">
 	<tr>
 		<td>创建时间</td>
		<td>名称|交易号</td>
		<td>对方</td>
		<td>金额|明细</td>     
		<td>状态</td>
		<td>操作</td>
	</tr>
		<?php if ($order_infos){foreach($order_infos as $_v){?>
	<tr>
		<td><?php echo $_v['order_add_time'] ?> </td>		        	
	    <td><?php echo $_v['subject'] ?><br>交易号：<?php echo $_v['out_trade_no']?></td>
	    <td><?php echo $_v['merchant_name'] ?> </td>
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
