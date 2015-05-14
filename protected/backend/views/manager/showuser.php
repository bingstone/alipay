<?php 
	$this->breadcrumbs = array(
				'管理员信息'=>array('/index/index'),
				'用户管理',
			);
?>
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE,
		Yii::app()->createUrl($this->route),
		'post'); ?>
	余额搜索:
    <?php echo TbHtml::textField('start_balance', '',
    	 array('placeholder' => '起始余额','prepend' => '$', 'append' => '.00', 'span' => 1)); ?>
    —
    <?php echo TbHtml::textField('end_balance', '',
    	 array('placeholder' => '结束余额','prepend' => '$', 'append' => '.00', 'span' => 1)); ?>
    <?php echo TbHtml::submitButton('搜索'); ?>
    <?php echo TbHtml::linkButton('显示全部',array('url'=>ADMIN.'manager/showuser'))?>
    <?php echo TbHtml::endForm(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
            				'type'=>TbHtml::GRID_TYPE_STRIPED,
						    'dataProvider' => $model->search(),
						    'filter' => $model,
						    'template' => '{items}{pager}',
							'columns' => array(
							    array(
								    'name' => 'user_id',
								    'header' => '用户id',								   
							    ),
							    array(
								    'name' => 'user_name',
								    'header' => '用户名',
							    	'htmlOptions'=>array('style'=>'width:50px'),
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
						    		'name' => 'ali_balance',
						    		'header' => '账户余额',
						    		'htmlOptions'=>array('style'=>'width:60px'),
						    	),
						    	array(
						    		'name' => 'ali_freeze',
						    		'header' => '冻结资金',
						    		'htmlOptions'=>array('style'=>'width:60px'),
						    	),
							   	array(
							   		'name' => 'user_sex',
							   		'header' => '性别',
							   	),
							   	array(
							   		'name' => 'user_birth',
							   		'header' => '出生日期',
							   	),
							   	array(
							   		'name' => 'user_country',
							   		'header' => '国家',
							   	),
						    	array(
						    			'name' => 'user_address',
						    			'header' => '地址',
						    	),							
							   /*  array(
							    	'name' => 'user_lastip',
							    	'header' => '注册ip地址',
							    ), */
							    array(
							    	'name' => 'user_addtime',
							    	'header' => '注册时间',
							    	'htmlOptions'=>array('style'=>'width:120px'),
							    ),
						    	array(
						    		'class' => 'bootstrap.widgets.TbButtonColumn',						    		
						    		'header' =>'操作',
						    		'deleteConfirmation'=>"确认删除？",
						    		'buttons'=>array(
						    			'update'=>array(
						    					'url'=>'Yii::app()->controller->createUrl("updateuser",array("id"=>$data->user_id))',						    					
						    			),
						    			'delete'=>array(
						   						'url'=>'Yii::app()->controller->createUrl("deleteuser",array("id"=>$data->user_id))',
						   				),
						   				'view'=>array(
						   						'url'=>'Yii::app()->controller->createUrl("orderviewuser",array("type"=>"all","id"=>$data->user_id))',
					    				),
						    		),
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