<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>用户列表</title>

       <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet" />
       <link href="<?php echo MANAGE_CSS_URL; ?>pager.css" type="text/css" rel="stylesheet" />
       <link href="<?php echo MANAGE_CSS_URL; ?>/gridview/styles.css" type="text/css" rel="stylesheet" />      
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：用户管理-》用户订单列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo MANAGE;?>manager/adduser">【添加用户】</a>
                </span>
            </span>
        </div>
        <div class="div_search">
            <span style="float: left;border: solid #1c94c4 1px;margin-top:6px;">
            	<?php $form = $this ->beginWidget('CActiveForm', array('method'=>'get', 'action'=>'showuser')); ?>
                	<?php echo CHtml::label('精确搜索：',false);?>
                	<?php echo CHtml::dropDownList('search_type','',array(1=>'用户id',2=>'用户名',3=>'电话号码',4=>'电子邮箱',5=>'国家'));?>
                	<?php echo CHtml::textField('search_value','',array('class'=>'tb_input'));?>
                   	<?php echo CHtml::submitButton('搜索',array('class'=>'but_confirm')); ?>
               	<?php $this -> endwidget(); ?>               	                                 
            </span>
            <span style="float: left; margin-left: 15px;border: solid #1c94c4 1px;margin-top:6px;">
            <?php $form = $this ->beginWidget('CActiveForm', array('method'=>'get', 'action'=>'showuser')); ?>
                 	<?php echo CHtml::label('余额搜索：',false);?>
                	<?php echo CHtml::textField('start_time','',array('class'=>'tb_input_min'));?>
                	<?php echo CHtml::label('--',false);?>
                	<?php echo CHtml::textField('end_time','',array('class'=>'tb_input_min'));?>
                   	<?php echo CHtml::submitButton('搜索',array('class'=>'but_confirm')); ?>
                <?php $this -> endwidget(); ?>  
            </span>
        </div>        
        <div >
        <?php
      		$this->widget('zii.widgets.grid.CGridView', array(
				    'dataProvider'=> $dataProvider,      				
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
				        'user_name',          // display the 'title' attribute
				        //'user_passwd',  // display the 'name' attribute of the 'category' relation
				        'user_phone',   // display the 'content' attribute as purified HTML
				    	'ali_email',				    	
				    	'ali_balance',
				    	'user_sex',
				    	'user_ico',
				    	'user_birth',
				    	'user_country',
				    	'user_address',
				    	'user_lastlogin',
				    	'user_lastip',
				    	'user_addtime',
				        /* array(            // display 'create_time' using an expression
				            'name'=>'create_time',
				            'value'=>'date("M j, Y", $data->create_time)',
				        ),
				        array(            // display 'author.username' using an expression
				            'name'=>'authorName',
				            'value'=>'$data->author->username',
				        ),*/
				        array(            // display a column with "view", "update" and "delete" buttons
				            'class'=>'CButtonColumn',
				        	'template'=>'{update} {delete} {view}',	
				        	'header' =>'Operate',
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
      				'summaryText'=>'共<span style="color:red;">{count}</span>条&nbsp;&nbsp;当前:<span style="color:red;">{page}</span>-<span style="color:red;">{end}</span>条',      				
				));
      		?>
        </div>
    </body>
</html>