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
				'注册付款密码',
			);
?>
		<div style="padding-left: 10%;">
			<?php echo $form; ?>
		</div>
    </body>
</html>