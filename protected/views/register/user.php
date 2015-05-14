<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
	
	    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
		<?php Yii::app()->bootstrap->register(); ?>	
	</head>
	
	<body>
<?php 
	$this->breadcrumbs = array(
				'用户登录'=>array('/index/login'),
				'添加用户',
			);
?>

<?php 
 $BFHCountriesList = array( 'Afghanistan',
 'Albania',
 'Algeria',
 'American Samoa',
 'Andorra',
 'Angola',
 'Anguilla',
 'Antarctica',
 'Antigua and Barbuda',
 'Argentina',
 'Armenia',
 'Aruba',
 'Australia',
 'Austria',
 'Azerbaijan',
 'Bahrain',
 'Bangladesh',
 'Barbados',
 'Belarus',
 'Belgium',
 'Belize',
 'Benin',
 'Bermuda',
 'Bhutan',
 'Bolivia',
 'Bosnia and Herzegovina',
 'Botswana',
 'Bouvet Island',
 'Brazil',
 'British Indian Ocean Territory',
 'British Virgin Islands',
 'Brunei',
 'Bulgaria',
 'Burkina Faso',
 'Burundi',
 'Côte d\'Ivoire',
 'Cambodia',
 'Cameroon',
 'Canada',
 'Cape Verde',
 'Cayman Islands',
 'Central African Republic',
 'Chad',
 'Chile',
 'China',
 'Christmas Island',
 'Cocos (Keeling) Islands',
 'Colombia',
 'Comoros',
 'Congo',
 'Cook Islands',
 'Costa Rica',
 'Croatia',
 'Cuba',
 'Cyprus',
 'Czech Republic',
 'Democratic Republic of the Congo',
 'Denmark',
 'Djibouti',
 'Dominica',
 'Dominican Republic',
 'East Timor',
 'Ecuador',
 'Egypt',
 'El Salvador',
 'Equatorial Guinea',
 'Eritrea',
 'Estonia',
 'Ethiopia',
 'Faeroe Islands',
 'Falkland Islands',
 'Fiji',
 'Finland',
 'Former Yugoslav Republic of Macedonia',
 'France',
 'France, Metropolitan',
 'French Guiana',
 'French Polynesia',
 'French Southern Territories',
 'Gabon',
 'Georgia',
 'Germany',
 'Ghana',
 'Gibraltar',
 'Greece',
 'Greenland',
 'Grenada',
 'Guadeloupe',
 'Guam',
 'Guatemala',
 'Guinea',
 'Guinea-Bissau',
 'Guyana',
 'Haiti',
 'Heard and Mc Donald Islands',
 'Honduras',
 'Hong Kong',
 'Hungary',
 'Iceland',
 'India',
 'Indonesia',
 'Iran',
 'Iraq',
 'Ireland',
 'Israel',
 'Italy',
 'Jamaica',
 'Japan',
 'Jordan',
 'Kazakhstan',
 'Kenya',
 'Kiribati',
 'Kuwait',
 'Kyrgyzstan',
 'Laos',
 'Latvia',
 'Lebanon',
 'Lesotho',
 'Liberia',
 'Libya',
 'Liechtenstein',
 'Lithuania',
 'Luxembourg',
 'Macau',
 'Madagascar',
 'Malawi',
 'Malaysia',
 'Maldives',
 'Mali',
 'Malta',
 'Marshall Islands',
 'Martinique',
 'Mauritania',
 'Mauritius',
 'Mayotte',
 'Mexico',
 'Micronesia',
 'Moldova',
 'Monaco',
 'Mongolia',
 'Montenegro',
 'Montserrat',
 'Morocco',
 'Mozambique',
 'Myanmar',
 'Namibia',
 'Nauru',
 'Nepal',
 'Netherlands',
 'Netherlands Antilles',
 'New Caledonia',
 'New Zealand',
 'Nicaragua',
 'Niger',
 'Nigeria',
 'Niue',
 'Norfolk Island',
 'North Korea',
 'Northern Marianas',
 'Norway',
 'Oman',
 'Pakistan',
 'Palau',
 'Palestine',
 'Panama',
 'Papua New Guinea',
 'Paraguay',
 'Peru',
 'Philippines',
 'Pitcairn Islands',
 'Poland',
 'Portugal',
 'Puerto Rico',
 'Qatar',
 'Reunion',
 'Romania',
 'Russia',
 'Rwanda',
 'São Tomé and Príncipe',
 'Saint Helena',
 'St. Pierre and Miquelon',
 'Saint Kitts and Nevis',
 'Saint Lucia',
 'Saint Vincent and the Grenadines',
 'Samoa',
 'San Marino',
 'Saudi Arabia',
 'Senegal',
 'Serbia',
 'Seychelles',
 'Sierra Leone',
 'Singapore',
 'Slovakia',
 'Slovenia',
 'Solomon Islands',
 'Somalia',
 'South Africa',
 'South Georgia and the South Sandwich Islands',
 'South Korea',
 'Spain',
 'Sri Lanka',
 'Sudan',
 'Suriname',
 'Svalbard and Jan Mayen Islands',
 'Swaziland',
 'Sweden',
 'Switzerland',
 'Syria',
 'Taiwan',
 'Tajikistan',
 'Tanzania',
 'Thailand',
 'The Bahamas',
 'The Gambia',
 'Togo',
 'Tokelau',
 'Tonga',
 'Trinidad and Tobago',
 'Tunisia',
 'Turkey',
 'Turkmenistan',
 'Turks and Caicos Islands',
 'Tuvalu',
 'US Virgin Islands',
 'Uganda',
 'Ukraine',
 'United Arab Emirates',
 'United Kingdom',
 'United States',
 'United States Minor Outlying Islands',
 'Uruguay',
 'Uzbekistan',
 'Vanuatu',
 'Vatican City',
 'Venezuela',
 'Vietnam',
 'Wallis and Futuna Islands',
 'Western Sahara',
 'Yemen',
 'Zambia',
 'Zimbabwe'
)
        ?>
        
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'user-active_form-form',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'enableClientValidation'=>true,)
	);
?>
<fieldset>
	<legend>注册用户</legend>
	<?php echo $form->errorSummary($user_model);?>
	<?php echo $form->textFieldControlGroup($user_model, 'user_name', array('placeholder'=>'请输入用户名'));?>
	<?php echo $form->passwordFieldControlGroup($user_model, 'user_passwd', array('placeholder'=>'请输入登陆密码'));?>
	<?php echo $form->passwordFieldControlGroup($user_model, 'passwd2', array('placeholder'=>'请输入确认登陆密码'));?>
	<div style="padding-left: 100px;">	
		手机号码&nbsp&nbsp&nbsp&nbsp&nbsp
		<?php $this->widget('yiiwheels.widgets.formhelpers.WhPhone',array(
					'model'=>$user_model,
					'attribute'=>'user_phone',				
					//'value' => '13200010001',
					'format' => '+86 ddd-dddd-dddd',				
					'htmlOptions' => array(
						'class' => 'form-control',						
					)
				)
			);
		?>
	</div>
	<br/>	
	<?php //echo $form->textFieldControlGroup($user_model, 'user_phone',array('placeholder'=>'请输入用户手机号码'));?>
	<?php echo $form->textFieldControlGroup($user_model, 'ali_email', array('prepend' => '@', 'placeholder'=>'请输入邮件地址')); ?>
	<?php echo $form->textFieldControlGroup($user_model, 'ali_balance', array('append' => '.00', 'placeholder'=>'请输入初始余额')); ?>
	<?php echo $form->inlineRadioButtonListControlGroup($user_model, 'user_sex', $sex); ?>
	<div style="padding-left: 110px;">	
		所属国家&nbsp&nbsp&nbsp&nbsp&nbsp
		<?php $this->widget('bootstrap.widgets.TbTypeAhead', array(
					'model'=>$user_model,			    
					'attribute'=>'user_country',
				    'source' =>$BFHCountriesList,
					'value' => 'China',
				    'htmlOptions' => array(
					    'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
					    'placeholder' => '请输入国家'
				 ),
		    	)
			); 
		?>	
	</div>
	<br/>
	<br/>
	<div style="padding-left: 110px;">	
	出生日期&nbsp&nbsp&nbsp&nbsp&nbsp
		<div class="input-append">
		    <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
		    		'attribute'=>'user_birth',	    		
		    		'model'=>$user_model,
				    'pluginOptions' => array(
				    	'format' => 'yyyy-mm-dd',
				    	'placeholder' => '请选择生日日期'
				    	)
		    		)
		    	);
		    ?>
    		<span class="add-on"><icon class="icon-calendar"></icon></span>
    	</div>
    </div>
    <br/><br/>
    
	<?php echo $form->textAreaControlGroup($user_model, 'user_address', array('span' => 3, 'rows' => 3)); ?>
  	
	 </fieldset>
<?php echo TbHtml::formActions(array(
	TbHtml::submitButton('下一步', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
	TbHtml::resetButton('重设'),
)); ?>
<?php $this->endWidget();?>
	</body>
</html>