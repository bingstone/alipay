<?php
/*****************************************************************************
                   _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         God bless     never BUG
 
 * @charset UTF-8
 * @author wulin
 * @time 2014-12-10
 *****************************************************************************/
 


?>

<html>
    <head>
        <title>测试widget</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo MANAGE_CSS_URL; ?>mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：index</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo MANAGE;?>manager/showuser">返回</a>
                </span>
            </span>
        </div>      
        <div style="font-size: 13px;margin: 10px 5px">
       
        
			
			<table broder="1" width="100%" class="table_a">
		        <?php  echo CHtml::beginForm('adduser','get',array('name'=>'order_user')); ?>        
            	<tr>
                    <td>
                        <?php echo CHtml::label('标签1','input1');?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('input1'); ?>
                    </td>
                    <td>
                        <?php echo CHtml::htmlButton($label='button',$htmlOptions=array()); ?>
                    </td>                                        
                </tr>           		
                
                <tr>
                    <td>
                        <?php echo CHtml::label('标签2','input2');?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('input2'); ?>                               
                    </td>
                    <td>
                        <?php echo CHtml::button('按钮button'); ?>
                    </td>                                        
                </tr>
                
                <tr>
                    <td>
                        <?php echo CHtml::label('标签3','input3');?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('input3'); ?>                               
                    </td>
                    <td>
                        <?php /*echo CHtml::linkButton('按钮linkbutton');*/ ?>
                        <?php echo CHtml::link('立即注册', array('/auth/auth/regist'),array('target'=>'_blank')); ?>
                        <?php echo CHtml::link('Link Text', array('controller/action','param1'=>'value1'), array('target'=>'_blank'));?> 
                    </td>                                        
                </tr>
                
                <tr>
                
                  <td>
                      <?php echo CHtml::label('标签4','input3');?>
                  </td>
                  <td>
                      <?php echo CHtml::textField('input4'); ?>                               
                  </td>
                
                  <td>
                      <?php echo CHtml::submitButton('submit',array('name'=>'sub','value'=>'登录')); ?>
                  </td>
                
                  <td colspan="2" align="center">
                       <input type="submit" value="提交">
                  </td>
                  
                </tr>  
                <?php echo Chtml::endForm();?>
            </table>           
        </div>
    </body>
</html>
