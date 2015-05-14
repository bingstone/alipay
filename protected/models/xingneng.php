<?php
class xingneng extends CActiveRecord
{
	public function tableName()
	{
		return '{{XINGNENG}}';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}