<?php

/**
 * This is the model class for table "{{PAY_TYPE}}".
 *
 * The followings are the available columns in table '{{PAY_TYPE}}':
 * @property integer $pay_type_id
 * @property string $pay_type_name
 * @property string $pay_type_info
 */
class Paytype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{PAY_TYPE}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pay_type_name, pay_type_info', 'required'),
			array('pay_type_name', 'length', 'max'=>50),
			array('pay_type_info', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pay_type_id, pay_type_name, pay_type_info', 'safe', 'on'=>'search'),
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
				'order'=>array(self::HAS_MANY, 'Order', 'payment_type', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pay_type_id' => 'Pay Type',
			'pay_type_name' => 'Pay Type Name',
			'pay_type_info' => 'Pay Type Info',
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

		$criteria->compare('pay_type_id',$this->pay_type_id);
		$criteria->compare('pay_type_name',$this->pay_type_name,true);
		$criteria->compare('pay_type_info',$this->pay_type_info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paytype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
