<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商户管理-》管理用户登陆</span>                
            </span>
        </div>      
        <!-- <div> -->
        <div style="font-size: 13px;margin: 10px 5px;">
        	<?php $form = $this ->beginWidget('CActiveForm'); ?>
			<table broder="1" width="50%" class="table_a">
			<tr>
                    <td>
                        <?php echo $form -> labelEx($admin_login, 'username'); ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($admin_login,'username',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($admin_login,'username'); ?>                        
                    </td>                                        
                </tr>           		
                <tr>
                    <td>
                        <?php echo $form -> labelEx($admin_login, 'password'); ?>
                    </td>
                    <td>
                        <?php echo $form -> passwordField($admin_login,'password',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($admin_login,'password'); ?>
                    </td>
                </tr>
                <tr>
                	<td>
                		<?php echo $form->labelEx($admin_login, 'verifyCode'); ?>
                	</td>
                	<td>
                		<?php echo $form->textField($admin_login, 'verifyCode', array('class'=>'tb_input_captcha','maxlength'=>5)); ?>                		
                		<?php echo $form->error($admin_login,'verifyCode')?>
                	</td>      
                </tr>
                <tr>
                <td></td>
                <td>
                	<?php $this->widget('CCaptcha', array('buttonLabel'=>'换一个','clickableImage'=>true )); ?>
                </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                    	<?php echo $form -> checkBox($admin_login, 'rememberMe'); ?>                       
                        <?php echo $form ->labelEx($admin_login,'rememberMe'); ?>
                    </td>
                </tr>                                       
                <tr>
	                <td>
	                	<?php echo CHtml::submitButton('登陆',array('class'=>'but_confirm')); ?>
	                </td>   
                </tr>
                <?php $this -> endwidget(); ?>                   
        </div>
    </body>
</html>