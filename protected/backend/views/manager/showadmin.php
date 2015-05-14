<?php 
	$this->breadcrumbs = array(
				'管理员信息'=>array('/index/index'),
				'管理员管理',
			);
?>
<?php echo TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_INLINE,
		Yii::app()->createUrl($this->route),
		'post'); ?>
    <?php echo TbHtml::linkButton('显示全部',array('url'=>ADMIN.'manager/showadmin'))?>
    <?php echo TbHtml::endForm(); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
            				'type'=>TbHtml::GRID_TYPE_STRIPED,
						    'dataProvider' => $model->search(),
						    'filter' => $model,
						    'template' => '{items}{pager}',
							'columns' => array(
							    array(
								    'name' => 'admin_id',
								    'header' => '管理员id',								   
							    ),
							    array(
								    'name' => 'admin_name',
								    'header' => '管理员名',
							    	'htmlOptions'=>array('style'=>'width:50px'),
							    ),
							   /*  array(
							    	'name' => 'user_lastip',
							    	'header' => '注册ip地址',
							    ), */
							    array(
							    	'name' => 'admin_addtime',
							    	'header' => '注册时间',
							    	'htmlOptions'=>array('style'=>'width:120px'),
							    ),
						    	array(
						    		'class' => 'bootstrap.widgets.TbButtonColumn',						    		
						    		'header' =>'操作',
						    		'deleteConfirmation'=>"确认删除？",
						    		'buttons'=>array(
						    			'update'=>array(
						    					'url'=>'Yii::app()->controller->createUrl("updateadmin",array("id"=>$data->admin_id))',						    					
						    			),
						    			'delete'=>array(
						   						'url'=>'Yii::app()->controller->createUrl("deleteadmin",array("id"=>$data->admin_id))',
						   				),
						   				/*'view'=>array(
						   						'url'=>'Yii::app()->controller->createUrl("orderviewadmin",array("type"=>"all","id"=>$data->admin_id))',
					    				),*/
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