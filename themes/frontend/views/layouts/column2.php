<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="span2">
        <div id="sidebar">
        <?php
           /*  $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operations',
            )); */
            $this->widget('bootstrap.widgets.TbNav', array(
            	'type'=>TbHtml::NAV_TYPE_TABS,
            	'stacked' => true,
                //'items'=>$this->menu,
                //'htmlOptions'=>array('class'=>'operations'),
            	 /* 'items' => array(
						array('label' => '订单管理'),
						array('label' => '查看订单', 'icon'=>TbHtml::ICON_LIST, 'url' => MAIN.'user/orderview'),
						array('label' => '查看个人信息', 'icon'=>TbHtml::ICON_ALIGN_LEFT, 'url' => MAIN.'user/adduser'),
						array('label' => '账户充值', 'icon'=>TbHtml::ICON_INBOX, 'url' => MAIN.'user/showmerchant'),
            	 		array('label' => '充值记录', 'icon'=>TbHtml::CON_INDENT_LEFT, 'url' => MAIN.'user/addmerchant'),
						array('label' => '个人用户管理'),
						array('label' => '修改个人信息', 'icon'=>TbHtml::ICON_EDIT, 'url' => '#'),
						array('label' => '账单分析', 'icon'=>TbHtml::ICON_CALENDAR, 'url' => '#'),
						TbHtml::menuDivider(),
						array('label' => '帮助', 'url' => '#'),
						) */
            		'items' => array(
	            		array('label' => '用户管理'),
	            		array('label' => '查看订单', 'icon'=>TbHtml::ICON_LIST, 'url' => MAIN.'user/orderview/type/all'),
	            		array('label' => '查看个人信息', 'icon'=>TbHtml::ICON_PLUS, 'url' => MAIN.'user/userinfo'),
	            		array('label' => '账户充值', 'icon'=>TbHtml::ICON_LIST, 'url' => MAIN.'user/recharge'),
	            		array('label' => '充值记录', 'icon'=>TbHtml::ICON_PLUS, 'url' => MAIN.'user/rechargeuser'),
            			array('label' => '转账管理'),
            			array('label' => '转账用户', 'icon'=>TbHtml::ICON_LIST, 'url' => MAIN.'user/transfertouser'),
            			array('label' => '转账商家', 'icon'=>TbHtml::ICON_PLUS, 'url' => MAIN.'user/transfertomerchant'),
            			array('label' => '转账记录', 'icon'=>TbHtml::ICON_LIST, 'url' => MAIN.'user/transferrecord'),
            			array('label' => '管理员管理'),
	            		array('label' => '查看管理员', 'icon'=>TbHtml::ICON_LIST, 'url' => '#'),
	            		array('label' => '添加管理员', 'icon'=>TbHtml::ICON_PLUS, 'url' => '#'),
	            		TbHtml::menuDivider(),
	            		array('label' => '帮助', 'url' => '#'),
            		)
            ));
           // $this->endWidget();
        ?>
        </div><!-- sidebar -->
    </div>
    <div class="span10">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>