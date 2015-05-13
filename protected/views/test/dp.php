<?php
      		$this->widget('zii.widgets.grid.CGridView', array(
				    'dataProvider'=>$dataProvider,      				
      				'pager' => array(      						
      						'header'=>'',
      						'firstPageLabel'=>'首页',
      						'lastPageLabel'=>'尾页',
      						'nextPageLabel'=>'下一页',
      						'prevPageLabel'=>'前一页',
      						//'htmlOptions'=>array('class'=>'yiiPager',),
      						),
      				'template' => '{summary}{items}{pager}',      				
				    'columns'=>array(
				    		/* array('class' => 'CCheckBoxColumn',
				    			'selectableRows'=>2,
				    			'value' => $user_model->user_id,
				    			), */
				    	'user_id',
				    	'user.user_name',
				        'price',
				        /* array(            // display 'create_time' using an expression
				            'name'=>'create_time',
				            'value'=>'date("M j, Y", $data->create_time)',
				        ),
				        array(            // display 'author.username' using an expression
				            'name'=>'authorName',
				            'value'=>'$data->author->username',
				        ),*/
// 				        array(            // display a column with "view", "update" and "delete" buttons
// 				            'class'=>'CButtonColumn',
// 				        	'template'=>'{update} {delete} {view}',
// 				        	'header' =>'Operate',
// 				        	'deleteConfirmation'=>"确认删除？",
// 				        	'buttons'=>array(
// 				        			'update'=>array(
// 				        				'url'=>'Yii::app()->controller->createUrl("updatemerchant",array("id"=>$data->merchant_id))',
// 				        			),
// 				        			'delete'=>array(
// 				        				'url'=>'Yii::app()->controller->createUrl("deletemerchant",array("id"=>$data->merchant_id))',
// 				        			),
// 				        			'view'=>array(
// 				        				'url'=>'Yii::app()->controller->createUrl("orderviewmerchant",array("type"=>"all","id"=>$data->merchant_id))',
// 				        			),
// 				        		),				        	
// 				        ), 					    				    	
				    ),
      				'summaryText'=>'共<span style="color:red;">{count}</span>条&nbsp;&nbsp;当前:<span style="color:red;">{page}</span>-<span style="color:red;">{end}</span>条',      				
				));
      		?>