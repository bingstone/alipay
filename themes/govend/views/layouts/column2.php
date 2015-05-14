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
            	 		array('label' => '商户管理'),
            	 		array('label' => '查看个人信息', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'merchant/merchantinfo'),
            	 		array('label' => '订单管理'),
						array('label' => '查看订单', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'order/orderview/type/all'),
            	 		array('label' => '充值管理'),
            	 		array('label' => '账户充值', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'recharge/recharge'),
            	 		array('label' => '充值记录', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'recharge/rechargeuser'),
            	 		array('label' => '转账管理'),
            	 		array('label' => '转账用户', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'recharge/transfertouser'),
            	 		array('label' => '转账商户', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'recharge/transfertomerchant'),
            	 		array('label' => '转账记录', 'icon'=>TbHtml::ICON_LIST, 'url' => MERCHANT.'recharge/transferrecord'),
            	 		array('label' => '数据统计'),
            	 		array('label' => '交易数据统计', 'icon'=>TbHtml::ICON_LIST_ALT, 'url' => MERCHANT.'count/tradecount'),            	 		
            	 		array('label' => '订单数据统计', 'icon'=>TbHtml::ICON_LIST_ALT, 'url' => MERCHANT.'count/ordercount'),					
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