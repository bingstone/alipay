<?php 
	$this->breadcrumbs = array(
				'转账记录',
			);
?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
            				'type'=>TbHtml::GRID_TYPE_STRIPED,
						    'dataProvider' => $model->search(),
						    'filter' => $model,
						    'template' => '{items}{pager}',
							'columns' => array(
							    array(
								    'name' => 'transfertoid',
								    'header' => '转账id',								   
							    ),
									array(
											'name' => 'transfertoname',
											'header' => '转账名',
									),
									array(
											'name' => 'transfertoemail',
											'header' => '转账邮箱',
									),
							    array(
								    'name' => 'price',
								    'header' => '转账金额',
							    	//'htmlOptions'=>array('style'=>'width:50px'),
							    ),
							    array(
								    'name' => 'date',
								    'header' => '转账时间',
							    ),
							    array(
								    'name' => 'ip',
								    'header' => '转账地址',
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