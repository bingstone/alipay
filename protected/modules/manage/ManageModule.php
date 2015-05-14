<?php

class ManageModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'manage.models.*',
			'manage.components.*',
		));
		Yii::app()->setComponents(array(
			'admin'=>array(
				'class'=>'AdminUsers',
				'stateKeyPrefix'=>'admin',
				'allowAutoLogin'=>false,
				'loginUrl'=>MANAGE.'admin/login',
				),				
			) 
		);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			$route = $controller->id.'/'.$action->id;
			$route = strtolower($route);
			//echo $route;
			$filterpage =array(
					'manager/adduser',
					'manager/addmerchant',
					'manager/deletemerchant',
					'manager/deleteuser',
					'manager/orderviewmerchant',
					'manager/orderviewuser',
					'manager/showmerchant',
					'manager/showuser',
					'manager/updatemerchant',
					'manager/updateuser'
			);
			if(Yii::app()->admin->isGuest && in_array($route, $filterpage))
				Yii::app()->admin->loginRequired();
			else
				return true;
		}
		return false;
	}
}
