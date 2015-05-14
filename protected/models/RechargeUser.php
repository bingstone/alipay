<?php
class RechargeUser extends CActiveRecord
{
	public function tableName()
	{
		return '{{RECHARGE_USER}}';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
	
			$criteria->compare('user_id',$this->user_id,true);
			$criteria->compare('recharge',$this->recharge,true);
			$criteria->order='date desc';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>7,
				),
		));
	}
}