<?php 
	$this->breadcrumbs = array(
				'用户订单',
			);
?>
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE,
		Yii::app()->createUrl($this->route),
		'get'); ?>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			    'brandLabel' => '订单',
			    'display' => null, // default is static to top
				
			    'items' => array(			    		
					    array(
						    'class' => 'bootstrap.widgets.TbNav',
							 'items' => array(
								array('label' => '今天', 'url' => Yii::app()->controller->createUrl("orderview",array("type"=>"date_today" ))),
								array('label' => '最近1个月', 'url' => Yii::app()->controller->createUrl("orderview",array("type"=>"date_month" ))),
								array('label' => '3个月', 'url' => Yii::app()->controller->createUrl("orderview",array("type"=>"date_month_three" ))),
							 	array('label' => '1年', 'url' => Yii::app()->controller->createUrl("orderview",array("type"=>"date_year_one" ))),
							 	array('label' => '1年前', 'url' => Yii::app()->controller->createUrl("orderview",array("type"=>"date_year_before" ))),							 	
						    ),					    	
					    ),
			    		TbHtml::b('起止日期：'),
			    		array(
			    				'class' =>'yiiwheels.widgets.datepicker.WhDatePicker',
			    				'name' => 'start_date',
			    				'value'=> '',
			    				'pluginOptions' => array(
			    						'format' => 'yyyy-mm-dd'
			    				),
			    				'htmlOptions' => array(
			    						'style'=>'width:80px; height:20px; margin-top:5px; margin-bottom:5px;'
			    				),
			    		),
			    		//TbHtml::icon("icon-calendar",array('class'=>"add-on")),
						TbHtml::b('——'),
			    		array(
			    				'class' =>'yiiwheels.widgets.datepicker.WhDatePicker',
			    				'name' => 'end_date',
			    				'value'=> '',
			    				'pluginOptions' => array(
			    						'format' => 'yyyy-mm-dd'
			    				),
			    				'htmlOptions' => array(
			    						'style'=>'width:80px; height:20px; margin-top:5px; margin-bottom:5px;'
			    				),
			    		),
			    		
			    		TbHtml::submitButton('搜索', array('style'=>'margin-top:5px; margin-bottom:5px;')),
			    ),			
		    )
		);
?>
<?php echo TbHtml::endForm(); ?>   
    <?php echo TbHtml::pills(array(
    		array('label'=>'交易状态:','url'=>'#', 'disabled' => true),
    		array('label'=>'进行中', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_processing" ))),
    		array('label'=>'未付款', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_pay_no" ))),
    		array('label'=>'等待发货', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_waiting" ))),
    		array('label'=>'未确认收货', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_receipt_no" ))),
    		array('label'=>'交易成功', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_success" ))),
    		array('label'=>'交易失败', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"trade_failure" ))),
    		array('label'=>'全部', 'url'=>Yii::app()->controller->createUrl("orderview",array("type"=>"all" ))),
    	));
    ?>
     	<table width="100%">
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
        	<td><?php echo $_v['subject'] ?><br>交易号：<?php echo $_v['ali_order_id']?></td>
        	<td><?php echo $_v['merchant_name'] ?> </td>
        	<td><?php echo $_v['price'] ?> </td>
        	<td><?php echo $_v['status_info'] ?> </td>
        	<td><?php switch ($_v['status_id']) {
        		case 1:
        			echo TbHtml::link('确认付款',MAIN.'user/confirmpay/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			echo '<br />';
        			echo TbHtml::link('查看订单',MAIN.'user/showorder/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			break;
        		case 4:
        			echo TbHtml::link('查看订单',MAIN.'user/showorder/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			break;
        		case 6:
        			echo TbHtml::link('确认收货',MAIN.'user/confirmreceipt/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			echo '<br />';
        			echo TbHtml::link('查看订单',MAIN.'user/showorder/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			break;
        		case 9:
        			echo '交易完成';  
        			echo '<br />';
        			echo TbHtml::link('查看订单',MAIN.'user/showorder/order_id/'.$_v['ali_order_id'], array('target'=>'_blank'));
        			break;
        		default:
        			echo $_v['status_id'];
        	} ?> </td>	        	 		       	
        </tr>
        <?php }}?>
        <tr>
        	<td colspan="20" style="text-align: center;">
        		<?php echo $page_list; ?>        		
	        	</td>
	        </tr>
        </table>
 