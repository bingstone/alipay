<?php

/**
 * This is the model class for table "{{NOTICE}}".
 *
 * The followings are the available columns in table '{{NOTICE}}':
 * @property string $notify_id
 * @property integer $order_id
 * @property string $notify_type
 * @property string $notify_info
 * @property integer $is_success
 * @property string $notify_send_time
 * @property string $notify_receive_time
 */
class Notice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{NOTICE}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notify_id, order_id, notify_info', 'required'),
			array('order_id, is_success', 'numerical', 'integerOnly'=>true),
			array('notify_id', 'length', 'max'=>100),
			array('notify_type, notify_info', 'length', 'max'=>20),
			array('notify_send_time, notify_receive_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('notify_id, order_id, notify_type, notify_info, is_success, notify_send_time, notify_receive_time', 'safe', 'on'=>'search'),
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
				'order'=>array(self::BELONGS_TO, 'Order', 'order_id', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notify_id' => '通知号(字符串)',
			'order_id' => '订单号',
			'notify_type' => '通知方式',
			'notify_info' => '通知内容',
			'is_success' => '是否通知到',
			'notify_send_time' => '通知发出时间',
			'notify_receive_time' => '通知被确认时间',
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

		$criteria->compare('notify_id',$this->notify_id,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('notify_type',$this->notify_type,true);
		$criteria->compare('notify_info',$this->notify_info,true);
		$criteria->compare('is_success',$this->is_success);
		$criteria->compare('notify_send_time',$this->notify_send_time,true);
		$criteria->compare('notify_receive_time',$this->notify_receive_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
