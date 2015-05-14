<?php

/**
 * This is the model class for table "{{ORDER_STATUS}}".
 *
 * The followings are the available columns in table '{{ORDER_STATUS}}':
 * @property integer $status_id
 * @property string $status_name
 * @property string $status_info
 * @property integer $final_flag
 */
class Orderstatus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ORDER_STATUS}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_name, status_info, final_flag', 'required'),
			array('final_flag', 'numerical', 'integerOnly'=>true),
			array('status_name', 'length', 'max'=>100),
			array('status_info', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status_id, status_name, status_info, final_flag', 'safe', 'on'=>'search'),
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
				'order'=>array(self::HAS_MANY, 'Order', 'status_id', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status_id' => 'Status',
			'status_name' => 'Status Name',
			'status_info' => 'Status Info',
			'final_flag' => 'Final Flag',
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

		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('status_name',$this->status_name,true);
		$criteria->compare('status_info',$this->status_info,true);
		$criteria->compare('final_flag',$this->final_flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orderstatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
