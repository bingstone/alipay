<?php 
	$this->breadcrumbs = array(
				'商户信息'
			);
?>
<?php
	echo TbHtml::media(MANAGE_IMG_URL.'admin_p.gif' , '欢迎进入商户管理中心',			
			'<br/>'.TbHtml::lead('&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp商户名：'.
					$merchant_info[merchant_name].TbHtml::small('<br/>当前时间：'.date('Y-m-d H:i:s'))
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
                <td align=right width=100>商户id：</td>
                <td style="color: #880000">'.$merchant_info[merchant_id].'</td></tr>
            <tr>
			<tr>
                <td align=right width=100>商户名称：</td>
                <td style="color: #880000">'.$merchant_info[merchant_name].'</td></tr>
			<tr>
                <td align=right>工商注册号：</td>
                <td style="color: #880000">'.$merchant_info[commerce_no].'</td></tr>
            <tr>
            <tr>
                <td align=right>注册邮箱：</td>
                <td style="color: #880000">'.$merchant_info[merchant_email].'</td></tr>
            <tr>
                <td align=right>注册时间：</td>
                <td style="color: #880000">'.$merchant_info[merchant_addtime].'</td></tr>
            <tr>
                <td align=right>账户资金：</td>
                <td style="color: #880000">'.$merchant_info[balance].'</td></tr>
            <tr>
                <td align=right>联系电话：</td>
                <td style="color: #880000">'.$merchant_info[merchant_phone].'</td></tr>
            <tr>
                <td align=right>所属国家：</td>
                <td style="color: #880000">'.$merchant_info[merchant_country].'</td></tr>
            <tr>
                <td align=right>地址：</td>
                <td style="color: #880000">'.$merchant_info[merchant_address].'</td></tr>
            <tr>
                <td align=right>交易资金：</td>
                <td style="color: #880000">'.$merchant_info[tarde_finance].'</td></tr>
            </tr>  
			<tr>
                <td align=right>注册ip：</td>
                <td style="color: #880000">'.$merchant_info[merchant_ip].'</td></tr>
            </tr>             
        </table>'
		)
	); 
?>