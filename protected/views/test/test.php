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
 * @time 2014-12-3
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
                <span style="float:left">当前位置是：测试</span>
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
        
			
			<table broder="1" width="100%" class="table_a">
		                
            	<tr>
                    <td>
                        1
                    </td>
                    <td>
                        2
                                               
                    </td>                                        
                </tr>           		
                <tr>
                    <td>
                        3
                    </td>
                    <td>
                        <input type="button" value="确认付款" onClick="window.location.reload('/adduser');">
                    </td>
                </tr>
               <!--    //echo $this->redirect(array('test', 'id'=>123, ));
            	<tr>
                    <td>
                        <?php echo $form -> labelEx($user_model, 'user_phone') ?>
                    </td>
                    <td>
                        <?php echo $form -> textField($user_model,'user_phone',array('class'=>'tb_input')); ?>
                        <?php echo $form ->error($user_model,'user_phone'); ?>
                    </td>
                </tr>
                 -->
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
