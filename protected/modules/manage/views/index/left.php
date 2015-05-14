<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="<?php echo MANAGE_CSS_URL; ?>admin.css" type="text/css" rel="stylesheet" />
        <script language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
        </script>
    </head>
    <body>
        <table height="100%" cellspacing=0 cellpadding=0 width=170 
               background=<?php echo MANAGE_IMG_URL; ?>menu_bg.jpg border=0>
               <tr>
                <td valign=top align=middle>
                    <table cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td height=10></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(1) 
                                    href="javascript:void(0);">关于系统</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child1 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">系统简介</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">项目团队</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">功能管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">分类管理</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                            
                  <!--去掉新闻中心模块-->       
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(2) 
                                    href="javascript:void(0);">公告中心</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child2 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">公告管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">用户留言</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">回复管理</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(3) 
                                    href="javascript:void(0);">管理中心</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child3 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo MANAGE;?>manager/showuser" 
                                   target="right">用户管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo MANAGE;?>manager/adduser" 
                                   target="right">添加用户</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo MANAGE;?>manager/showmerchant" 
                                   target="right">商户管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="<?php echo MANAGE;?>manager/addmerchant" 
                                   target="right">添加商户</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(4) 
                                    href="javascript:void(0);">订单管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child4 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">客户服务</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">分类管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">子类管理</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>
                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(5) 
                                    href="javascript:void(0);">统计查询</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child5 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">分类管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">子类管理</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(6) 
                                    href="javascript:void(0);">金融管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child6 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">银行接口管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">银行接口查询</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">***</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">产品订购</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">链接管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">文件管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">信息转移</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(7) 
                                    href="javascript:void(0);">系统管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child7 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">基本设置</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">样式管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">栏目管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">功能管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">菜单管理</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">首页设置</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">管理员列表</a></td></tr>
                        <tr height=4>
                            <td colspan=2></td></tr></table>
                    <table cellspacing=0 cellpadding=0 width=150 border=0>

                        <tr height=22>
                            <td style="padding-left: 30px" background=<?php echo MANAGE_IMG_URL; ?>menu_bt.jpg><a 
                                    class=menuparent onclick=expand(0) 
                                    href="javascript:void(0);">个人管理</a></td></tr>
                        <tr height=4>
                            <td></td></tr></table>
                    <table id=child0 style="display: none" cellspacing=0 cellpadding=0 
                           width=150 border=0>

                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   href="#" 
                                   target="right">修改口令</a></td></tr>
                        <tr height=20>
                            <td align=middle width=30><img height=9 
                                                           src="<?php echo MANAGE_IMG_URL; ?>menu_icon.gif" width=9></td>
                            <td><a class=menuchild 
                                   onclick="if (confirm('确定要退出吗？')) return true; else return false;" 
                                   href="http://www.865171.cn" 
                                   target=_top>退出系统</a></td></tr></table></td>
                <td width=1 bgcolor=#d1e6f7></td>
            </tr>
        </table>
    </body>
