<?php
/*****************************************************************************
 *后台整体架构控制器
* @charset UTF-8
* @author wulin
* @time 2014-9-12
*****************************************************************************/


class IndexController extends Controller{
    /*
     * 生成头部
     */
    
     function actionHead(){
        $this->renderPartial('head');
    }
    
    /*
     * 生成左侧菜单
     */
    function actionLeft(){    	
        $this ->renderPartial('left');
    }

    /*
     * 生成右侧主体内容区域
     */
 
    function actionRight(){
    	$admin_info;
    	if(!empty(Yii::app()->admin->name)){    	    		
    		$Command=Yii::app()->db->createCommand ('UPDATE {{ADMIN}} SET admin_count=admin_count+1 WHERE admin_name=:name');
    		$Command->bindParam(':name',Yii::app()->admin->name, PDO::PARAM_STR);
    		$Command->execute();   		
    		$admin_info = Yii::app ()->db->createCommand ()
    				->select ( '*' )
    				->from ( '{{ADMIN}}' )
    				->where ( 'admin_name= :name', array (':name' => Yii::app()->admin->name))
    				->queryrow ();    		
    	}
        $this ->renderPartial('right',array('admin_info'=>$admin_info));
    }

    /*
     * 将头部、左侧、右侧集成到一起
     */

    function actionIndex(){
        $this ->render('index');
    }
}