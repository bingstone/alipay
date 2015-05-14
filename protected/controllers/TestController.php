<?php

class TestController extends Controller{

  public function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;
  
    for($i=0;$i<$length;$i++){
      $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }
  
    return $str;
  }
  
  public function actioncar(){
  	$tran = TransferFromUser::model();
  	$criteria = new CDbCriteria();
  	$criteria->alias = 't';
  	//$criteria->together = true;
  	$criteria->with = array('user');
  	$criteria->addSearchCondition('t.user_id','200818');
  	$criteria->select = array('t.user_id, u.user_name');  	
  	$criteria->limit = 1;
  	$res = $tran->findAll($criteria);
  	echo '</br>';
  	print_r($res);
  	$arr = (array)$res;
  	echo '</br>';
  	var_dump ($arr);
  	echo '</br>';
  	echo ':::';
  	var_dump($arr['user_id']);
  	//print_r($res['user']->user_name);
  	//echo $res['user']['user_name'];
  	
  	echo '</br>';
  	//print_r($res);
  	echo '</br>';
  	print_r($res['user']['user_name']);
  	//echo $res->user->user_id;
  	//print_r($res['user']['user_name']);
  	//var_dump($res['user_id']);
  }
  
  public function actionswb()
  {
  	/* if(isset($_GET['type']))
  	{
  		echo $_GET['type'];
  	}
  	echo 'happyswb'; */
  	$order = Order::model()->findByPk('');
  	$this->render('swb',array('id' => 1234, ));
  }
 
  public function actiontest(){
    
    echo $_SERVER ['DOCUMENT_ROOT'];
  }

  public function actionindex(){

    $url = "http://10.10.108.201/1/index.php?";
    $post_data = array (
        "ok" => "ok" ,
        "false" => "false" ,
        "defalt" => "defalt"
    ) ;
    $ch = curl_init ( ) ;
    curl_setopt ( $ch , CURLOPT_URL, $url ) ;
    curl_setopt ( $ch , CURLOPT_RETURNTRANSFER, 1 ) ;
    // 我们在POST数据哦！
    //curl_setopt ( $ch , CURLOPT_POST, 1 ) ;
    // 把post的变量加上
    curl_setopt ( $ch , CURLOPT_POSTFIELDS, $post_data ) ;
    $output = curl_exec ( $ch ) ;
    curl_close ( $ch ) ;
    //print_r( $output );  
    if ($output === 'ok')
      echo 'ok is ok';
    elseif ($output === 'false')
      echo 'false is ok';
    elseif ($output === 'defalt')
      echo 'defalt is ok';
    else 
      echo 'nothing is ok';

    
  }
  
  public function actionDp()
  {
  	$t_model = TransferFromUser::model();
  	//查询所有用户信息
  	$t_infos = $t_model->findAll();
  	$criteria = new CDbCriteria();
  	$dataProvider = new CActiveDataProvider('TransferFromUser',array(
  			'criteria'=>$criteria,
  			'pagination'=>array(
  					'pageSize'=>5
  			),
  	));
  	$this->layout = false;
  	$this->render('dp',array(
  			'dataProvider' => $dataProvider,));
  }
  
  public function actionPhpInfo(){
  	echo phpinfo();
  }
	
  public function actionXingnengInsert()
  {
  	if(isset($_POST['t1']))
  	{
  	$xn=new xingneng();
  	for($i=0;$i<11;$i++)
  	{
  		$xn->xn1.=chr(rand(1,135));
  		$xn->xn2.=chr(rand(1,135));
  		$xn->xn3.=chr(rand(1,135));
  		$xn->xn4.=chr(rand(1,135));
  		$xn->date=date("Y:m:d H:i:m");
  	}
  	if($xn->save())
  		echo "success";
  	else
  		echo "false";
  	}
  	else
  	$this->render('xingneng');
  }

  public function actionXingnengSelect()
  {
  	$xn=xingneng::model();
  	$result=$xn->findbyattributes(array('xn1'=>'*'));
  	$re=$xn->count($result);
  	echo "共有".$re."条记录";

  }
}

?>