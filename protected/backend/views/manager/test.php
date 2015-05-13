
<h1>Yii CJuiDialog : Animation</h1>
<?php
/** Start Widget **/
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialog-animation',
    'options'=>array(
        'title'=>'Dialog box - Animation',
        'autoOpen'=>false,
        'show'=>array(
                'effect'=>'blind',
                'duration'=>1000,
            ),
        'hide'=>array(
                'effect'=>'explode',
                'duration'=>500,
            ),            
    ),
));
    echo 'Animation Dialog Content';
$this->endWidget('zii.widgets.jui.CJuiDialog');
/** End Widget **/
echo CHtml::button('Open Dialog', array(
   'onclick'=>'$("#dialog-animation").dialog("open"); return false;',
));
?>
<h1>Yii CJuiDialog : Default</h1>
<?php
/** Start Widget **/
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog',
    'options'=>array(
        'title'=>'Dialog box',
        'autoOpen'=>false,
    ),
));
    echo 'dialog content here';
$this->endWidget('zii.widgets.jui.CJuiDialog');
/** End Widget **/
echo CHtml::link('Open Dialog', '#', array(
   'onclick'=>'$("#mydialog").dialog("open"); return false;',
));
?>

<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	'attribute'=>'visit_time',
	//'language'=>'zh_cn',
	'name'=>'visit_time',
	'options'=>array(
		'showAnim'=>'slideDown',
		'showOn'=>'both',
		'changeMonth'=>true,
		'changeYear'=>true,
		'dateFormat'=>'yy-dd-mm',	
	),
	'htmlOptions'=>array(
		'style'=>'',
	),
));
?>

<h1>Yii CJuiDatePicker: Display Button Bar(showButtonPanel)</h1>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'datepicker-showButtonPanel',
    'value'=>date('d-m-Y'),    
    'options'=>array(
        'showAnim'=>'slide',
//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
        'showButtonPanel'=>true,
    ),
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>

<h1>Yii CJuiDatePicker: Display Month & Year Menus</h1>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'datepicker-month-year-menu',
    'flat'=>true,//remove to hide the datepicker
    'options'=>array(
     'dateFormat' => 'yy-mm-dd',
        'showAnim'=>'slide',
//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
        'changeMonth'=>true,
        'changeYear'=>true,
        'yearRange'=>'2000:2099',
        'minDate' => '2000-01-01',      // minimum date
        'maxDate' => '2099-12-31',      // maximum date
    ),
    'htmlOptions'=>array(
        'style'=>''
    ),
));
?>
