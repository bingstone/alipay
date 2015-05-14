<?php
class TransferFromMerchant extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return '{{TRANSFERFROM_MERCHANT}}';
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
	
		$criteria->compare('merchant_id',$this->merchant_id,true);
		
		$criteria->order='date desc';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>7,
				),
		));
	}
}