<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="<?php echo MANAGE_CSS_URL; ?>admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" 
               background="<?php echo MANAGE_IMG_URL; ?>header_bg.jpg" border=0>
            <tr height=56>
                <td width=260><img height=56 src="<?php echo MANAGE_IMG_URL; ?>header_left.jpg" 
                                   width=260></td>
                <td style="font-weight: bold; color: #fff; padding-top: 20px" 
				<?php 
					if(Yii::app()->user->getIsGuest()){ 
				?>				
				align=middle>当前用户：<?php echo Yii::app()->user->name; ?> &nbsp;&nbsp; <a style="color: #fff" 
                                                        href="" 
                                                        target=main>注册管理员</a> &nbsp;&nbsp; <a style="color: #fff" 
                                                        " 
                                                        href="<?php echo ADMIN;?>admin/login" target=_top>登陆系统</a>
				<?php } else {?>
                    align=middle>当前用户：<?php echo Yii::app()->user->name; ?> &nbsp;&nbsp; <a style="color: #fff" 
                                                        href="" 
                                                        target=main>修改口令</a> &nbsp;&nbsp; <a style="color: #fff" 
                                                        onclick="if (confirm('确定要退出吗？')) return true; else return false;" 
                                                        href="<?php echo ADMIN;?>admin/logout" target=_top>退出系统</a>
                <?php } ?> 
                </td>
                <td align=right width=268><img height=56 
                                               src="<?php echo MANAGE_IMG_URL; ?>header_right.jpg" width=268></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="100%" border=0>
            <tr bgcolor=#1c5db6 height=4>
                <td></td>
            </tr>
        </table>
    </body>
</html>