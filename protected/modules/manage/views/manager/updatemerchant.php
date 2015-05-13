<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>更新商户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商户管理-》更新商户信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo MANAGE;?>manager/showmerchant">【返回】</a>
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
			<table broder="1" width="50%" class="table_a">
			<tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'merchant_name'); ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($merchant_info,'merchant_name',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info,'merchant_name'); ?>                        
                    </td>                                        
                </tr>           		
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'merchant_passwd'); ?>
                    </td>
                    <td>
                        <?php echo $form -> passwordField($merchant_info,'merchant_passwd',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info,'merchant_passwd'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'passwd2') ?>
                    </td>
                    <td>
                        <?php echo $form -> passwordField($merchant_info, 'passwd2',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info, 'passwd2'); ?>
                    </td>
                </tr>
            	<tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'commerce_no') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($merchant_info,'commerce_no',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info,'commerce_no'); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'balance') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($merchant_info,'balance',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info,'balance'); ?>
                    </td>
                </tr>               
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'merchant_email') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($merchant_info,'merchant_email',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($merchant_info,'merchant_email'); ?>
                    </td>
                </tr>              
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'merchant_phone') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($merchant_info,'merchant_phone',array('class'=>'tb_input'))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form -> labelEx($merchant_info, 'user_country') ?>
                    </td>
                    <td>
                    <?php 
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
									    'name'=>'merchant_country',
                        				'attribute'=>'merchant_country',
									    'source'=>$country,
                        				'model'=>$merchant_info,
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
                        <?php echo $form -> labelEx($merchant_info, 'merchant_address') ?>
                    </td>
                    <td>
                        <?php echo $form -> textArea($merchant_info,'merchant_address',array('class'=>'tb_inarea')); ?>
                    </td>
                </tr>
                <tr>
	                <td>
	                	<?php echo CHtml::submitButton('提交',array('class'=>'but_confirm')); ?>
	                </td>   
                </tr>
                <?php $this -> endwidget(); ?>                   
        </div>
    </body>
</html>
