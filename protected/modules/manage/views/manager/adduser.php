<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加用户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：用户管理-》添加用户</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo MANAGE;?>manager/showuser">返回</a>
                </span>
            </span>
        </div>      
        <div style="font-size: 13px;margin: 10px 5px">
        <?php 
        	$country=array('China', 'Korea', 'Japan', 'Germany', 'France', 'Britain', 'Italy', 
        			'Spain', 'Canada', 'USA', 'Mexico', 'Brazil');
        ?>
        
			<?php $form = $this ->beginWidget('CActiveForm',
						array(
								'enableClientValidation'=>true,
								'clientOptions'=>array(
										'validateOnSubmit'=>true,
								),								
						)
					); ?>
			<table broder="1" width="100%" class="table_a">
		                
            	<tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_name'); ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'user_name',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'user_name'); ?>                        
                    </td>                                        
                </tr>           		
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_passwd'); ?>
                    </td>
                    <td>
                        <?php echo $form -> passwordField($user_model,'user_passwd',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'user_passwd'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'passwd2') ?>
                    </td>
                    <td>
                        <?php echo $form -> passwordField($user_model, 'passwd2',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model, 'passwd2'); ?>
                    </td>
                </tr>
            	<tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_phone') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'user_phone',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'user_phone'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'ali_email') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'ali_email',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'ali_email'); ?>
                    </td>
                </tr>               
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'ali_balance') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'ali_balance',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'ali_balance'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_sex') ?>
                    </td>
                    <td>                        
                        <?php echo $form->radioButtonList($user_model,'user_sex',$sex,array('separator'=>'&nbsp;','class'=>'tb_input')); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_ico') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'user_ico',array('class'=>'tb_input'))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_birth') ?>
                    </td>
                    <td>
                       <?php 
         					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'attribute'=>'user_birth',
											'language'=>'zh_cn',											
         									'model'=>$user_model,
         									'name'=>'user_birth',
         									'value'=>date('y-d-m'),
											'options'=>array(
												'showAnim'=>'slideDown',
												'showOn'=>'both',
												'changeMonth'=>true,
												'changeYear'=>true,
												'dateFormat'=>'yy-dd-mm',
												'yearRange'=>'1914:',
												'minDate' => '1914-01-01',
												//'maxDate' => '2099-12-31',
											),
											'htmlOptions'=>array(
												'class'=>'tb_input'
											),
										)
         							);         					
         				?>
         				<?php echo $form ->error($user_model,'user_birth'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_country') ?>
                    </td>
                    <td>
                    <?php 
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
									    'name'=>'user_country',
                        				'attribute'=>'user_country',
									    'source'=>$country,
                        				'model'=>$user_model,
									    // additional javascript options for the autocomplete plugin
									    'options'=>array(
									        'minLength'=>'2',
									    ),
									    'htmlOptions'=>array(
									      'class'=>'tb_input'
									    ),
									)
                        		);
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_address') ?>
                    </td>
                    <td>
                        <?php echo $form -> textArea($user_model,'user_address',array('class'=>'tb_inarea')); ?>
                    </td>
                </tr>                                     
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="提交">
                    </td>
                </tr>  
            </table>
            <?php $this -> endwidget(); ?>            
        </div>
    </body>
</html>