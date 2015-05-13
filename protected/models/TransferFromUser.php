<?php
class TransferFromUser extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return '{{TRANSFERFROM_USER}}';
	}
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
	
	
		$criteria->compare('user_id',$this->user_id,true);
	
		$criteria->order='date desc';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>7,
				),
		));
	}
	public function relations()
	{
		return array(
				'user'=>array(self::BELONGS_TO,'User','','on'=>'t.user_id=user.user_id'),
				);
	}
}