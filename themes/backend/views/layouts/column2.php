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
            	 'items' => array(
						array('label' => '用户管理'),
						array('label' => '查看用户', 'icon'=>TbHtml::ICON_LIST, 'url' => ADMIN.'manager/showuser'),
						array('label' => '添加用户', 'icon'=>TbHtml::ICON_PLUS, 'url' => ADMIN.'manager/adduser'),
						array('label' => '查看商户', 'icon'=>TbHtml::ICON_LIST, 'url' => ADMIN.'manager/showmerchant'),
            	 		array('label' => '添加商户', 'icon'=>TbHtml::ICON_PLUS, 'url' => ADMIN.'manager/addmerchant'),
            	 		array('label' => '数据统计'),
            	 		array('label' => '商户数据统计', 'icon'=>TbHtml::ICON_LIST_ALT, 'url' => ADMIN.'count/merchantcount'),
            	 		array('label' => '用户数据统计', 'icon'=>TbHtml::ICON_LIST_ALT, 'url' => ADMIN.'count/usercount'),
            	 		array('label' => '订单数据统计', 'icon'=>TbHtml::ICON_LIST_ALT, 'url' => ADMIN.'count/ordercount'),
            	 		array('label' => '通知信息'),
            	 		array('label' => '同步消息响应',  'icon'=>TbHtml::ICON_LIST_ALT, 'url' => ADMIN.'notify/sync'),
            	 		array('label' => '异步消息响应',  'icon'=>TbHtml::ICON_LIST_ALT, 'url' => ADMIN.'notify/async'),
						array('label' => '管理员管理'),
						array('label' => '查看管理员', 'icon'=>TbHtml::ICON_LIST, 'url' => ADMIN.'manager/showadmin'),
						array('label' => '添加管理员', 'icon'=>TbHtml::ICON_PLUS, 'url' => ADMIN.'manager/addadmin'),
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