<?php 
	$this->breadcrumbs = array(
				'商户信息' => array('/order/index'),				
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
    <?php echo TbHtml::submitButton('搜索'); ?>
    &nbsp
    <a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=date_today" target="_self">今天</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=date_month_one" target="_self">最近1个月</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=date_month_three" target="_self">3个月</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=date_year_one" target="_self">1年</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=date_year_before" target="_self">1年前>></a>
	<?php echo TbHtml::endForm(); ?>
    <?php echo TbHtml::b('交易状态：');?>
    &nbsp
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_processing" target="_self">进行中</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_pay_no" target="_self">未付款</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_waiting" target="_self">等待发货</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_receipt_no" target="_self">未确认收货</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_success" target="_self">交易成功</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=trade_failure" target="_self">交易失败</a>
	<a class=menuchild href="<?php echo MERCHANT;?>order/orderview?type=all" target="_self">全部</a>
	<br/><br/>
	<?php $this->widget('bootstrap.widgets.TbModal', array(
						'id' => 'myModal',
						'header' => 'Modal Heading',
						'content' => '<p>One fine body...</p>',
						'footer' => array(
							TbHtml::button('Save Changes', array('data-dismiss' => 'modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
							TbHtml::button('Close', array('data-dismiss' => 'modal')
						),
					),
				)
			); 
	?>
<table width="100%">
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
		<td><?php 
				if ($_v['status_id'] == 4) {
					echo TbHtml::link('发货',MERCHANT.'order/sendgoods/order_id/'.$_v['ali_order_id'],
							array('target'=>'_blank',
									));
					/* echo TbHtml::link('发货','javascript.void(0)',
							array('target'=>'_blank',
									'onclick' => '',
									'style' => TbHtml::BUTTON_COLOR_PRIMARY,
									'size' => TbHtml::BUTTON_SIZE_SMALL,
									'data-order'=> '123456',
									'data-toggle' => 'modal',
									'data-target' => '#myModal',)); */
					/* echo TbHtml::link('发货',MERCHANT.'order/sendgoods/order_id/'.$_v['ali_order_id'], 
							array('target'=>'_blank', 
							'style' => TbHtml::BUTTON_COLOR_PRIMARY,
							'size' => TbHtml::BUTTON_SIZE_SMALL, 
							'data-order'=> '123456',
							'data-toggle' => 'modal',
							'data-target' => '#myModal',)); */
					/* echo TbHtml::linkButton('发货',array(
							'url'=>MERCHANT.'order/sendgoods/order_id/'.$_v['ali_order_id'], 
							'target'=>'_blank', 
							'style' => TbHtml::BUTTON_COLOR_PRIMARY,
							'size' => TbHtml::BUTTON_SIZE_SMALL, 
							'data-toggle' => 'modal',
							'data-target' => '#myModal',
							)
						); */
				}
				else 
					echo $_v['status_id'];
			?> 
		</td>	        	 		       	
	</tr>
	<?php }}?>
	<tr>
		<td colspan="20" style="text-align: center;">
			<?php echo $page_list; ?>        		
		</td>
	</tr>
</table>
<script>
   $(function () { $('#myModal').on('shown.bs.modal', function () {
	   //window.open("www.baidu.com"+this.dataset.toggle);
	   alert(this.dataset.order);
	   }
   )
   });
</script>