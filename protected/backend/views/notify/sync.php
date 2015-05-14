<?php 
	$this->breadcrumbs = array(
				'管理员信息' => array('/index/index'),
				'同步通知响应'				
			);
?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
            				'type'=>TbHtml::GRID_TYPE_STRIPED,
						    'dataProvider' => $dataProvider,						    
						    'template' => '{items}{pager}',		
							'columns' => array(
							    array(
								    'name' => 'order_id',
								    'header' => '订单id',								   
							    ),
							    array(
								    'name' => 'notify_type',
								    'header' => '通知类型',
							    	//'htmlOptions'=>array('style'=>'width:50px'),
							    ),
							    array(
								    'name' => 'notify_info',
								    'header' => '通知信息',
							    ),
							    array(
								    'name' => 'notify_send_time',
								    'header' => '通知发送时间',
							    ),
						    	array(
						    		'name' => 'notify_receive_time',
						    		'header' => '通知接收时间',
						    		//'htmlOptions'=>array('style'=>'width:60px'),
						    	),						    							    				 
							),
            			'pager' => array('class' => 'bootstrap.widgets.TbPager', 
           						'size'=>TbHtml::PAGINATION_SIZE_SMALL,
           						'maxButtonCount'=>10,
           						'prevPageLabel'=>'上一页',
           						'firstPageLabel'=>'首页',
           						'lastPageLabel'=>'尾页',
           						'nextPageLabel'=>'下一页'
          					),
         			//'summaryText'=>'共<span style="color:red;">{count}</span>条&nbsp;&nbsp;当前:<span style="color:red;">{page}</span>-<span style="color:red;">{end}</span>条',
		)
   	);
?>