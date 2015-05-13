<?php
class RechargeMerchant extends CActiveRecord
{
	public function tableName()
	{
		return '{{RECHARGE_MERCHANT}}';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
	
		$criteria->compare('merchant_name',$this->merchant_name,true);
		$criteria->order='date desc';	
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>7,
				),
		));
	}
}