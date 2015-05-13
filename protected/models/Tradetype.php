<?php

/**
 * This is the model class for table "{{TRADE_TYPE}}".
 *
 * The followings are the available columns in table '{{TRADE_TYPE}}':
 * @property integer $trade_type_id
 * @property string $trade_type_name
 * @property string $trade_type_info
 */
class Tradetype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{TRADE_TYPE}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trade_type_name, trade_type_info', 'required'),
			array('trade_type_name', 'length', 'max'=>100),
			array('trade_type_info', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('trade_type_id, trade_type_name, trade_type_info', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'order'=>array(self::HAS_MANY, 'Order', 'trade_type_id', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'trade_type_id' => 'Trade Type',
			'trade_type_name' => 'Trade Type Name',
			'trade_type_info' => 'Trade Type Info',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('trade_type_id',$this->trade_type_id);
		$criteria->compare('trade_type_name',$this->trade_type_name,true);
		$criteria->compare('trade_type_info',$this->trade_type_info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tradetype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
