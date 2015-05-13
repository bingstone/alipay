<?php 
	$this->breadcrumbs = array(
				'管理员信息'
			);
?>
<?php
	echo TbHtml::media(MANAGE_IMG_URL.'admin_p.gif' , '欢迎进入网站管理中心',			
			'<br/>'.TbHtml::lead('&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp管理员：'.
					$admin_info[admin_name].TbHtml::small('<br/>当前时间：'.date('Y-m-d H:i:s'))
			)
		);
?>
<?php
	/* $this->widget('yiiwheels.widgets.box.WhBox', array(
			'title' => '您的相关信息',
			'headerIcon' => 'icon-home',
			'content' => '当前时间：'.date('Y-m-d H:i:s').'<br/>'.
						'登陆帐号：'.$admin_info[admin_name].'<br/>'.
						'注册邮箱：'.$admin_info[ali_email].'<br/>'.
						'注册时间：'.$admin_info[admin_addtime].'<br/>'.
						'登陆次数：'.$admin_info[admin_count].'<br/>'.
						'上线时间：'.$admin_info[admin_lastlogin].'<br/>'.
						'ip地址：'.$admin_info[admin_lastip].'<br/>'.
						'身份过期：永久<br/>网站开发qq：215288671',
		)
	);  */
?>
<?php
	$this->widget('yiiwheels.widgets.box.WhBox', array(
			'title' => '您的相关信息',
			'headerIcon' => 'icon-home',
			'content' =>  '<table cellspacing=0 cellpadding=2 width="95%" align=center border=0>
            <tr>
                <td align=right width=100>登陆帐号：</td>
                <td style="color: #880000">'.$admin_info[admin_name].'</td></tr>
            <tr>
                <td align=right>注册邮箱：</td>
                <td style="color: #880000">'.$admin_info[ali_email].'</td></tr>
            <tr>
                <td align=right>注册时间：</td>
                <td style="color: #880000">'.$admin_info[admin_addtime].'</td></tr>
            <tr>
                <td align=right>登陆次数：</td>
                <td style="color: #880000">'.$admin_info[admin_count].'</td></tr>
            <tr>
                <td align=right>上线时间：</td>
                <td style="color: #880000">'.$admin_info[admin_lastlogin].'</td></tr>
            <tr>
                <td align=right>ip地址：</td>
                <td style="color: #880000">'.$admin_info[admin_lastip].'</td></tr>
            <tr>
                <td align=right>身份过期：</td>
                <td style="color: #880000">永久</td></tr>
            <tr>
                <td align=right>网站开发qq：</td>
                <td style="color: #880000">215288671</td></tr>
            </tr>              
        </table>'
		)
	); 
?>