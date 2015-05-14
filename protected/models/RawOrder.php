<?php

/**
 * This is the model class for table "{{ORDER}}".
 *
 * The followings are the available columns in table '{{ORDER}}':
 * @property string $ali_order_id
 * @property integer $out_trade_no
 * @property string $buyer_id
 * @property string $buyer_email
 * @property string $seller_email
 * @property string $partner
 * @property integer $trade_type_id
 * @property integer $status_id
 * @property integer $payment_type
 * @property string $price
 * @property integer $quantity
 * @property string $logistics_payment
 * @property string $logistics_type
 * @property string $logistics_fee
 * @property string $subject
 * @property string $body
 * @property string $show_url
 * @property string $notify_url
 * @property string $return_url
 * @property string $receive_name
 * @property integer $receive_zip
 * @property string $receive_address
 * @property integer $receive_phone
 * @property integer $receive_mobile
 * @property string $sign_type
 * @property string $sign
 * @property string $_input_charset
 * @property string $order_add_time
 * @property string $order_update_time
 */
class RawOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ORDER}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/* return array(
			array('ali_order_id, out_trade_no, seller_email, partner, price, subject, notify_url, return_url, receive_name, receive_zip, receive_address, receive_mobile, sign', 'required'),
			array('out_trade_no, trade_type_id, status_id, payment_type, quantity, receive_zip, receive_phone, receive_mobile', 'numerical', 'integerOnly'=>true),
			array('ali_order_id', 'length', 'max'=>32),
			array('buyer_id, partner, logistics_payment, logistics_type, sign_type, _input_charset', 'length', 'max'=>16),
			array('buyer_email, seller_email, body, show_url, receive_address', 'length', 'max'=>100),
			array('price, logistics_fee, subject', 'length', 'max'=>20),
			array('notify_url, return_url', 'length', 'max'=>160),
			array('receive_name', 'length', 'max'=>50),
			array('sign', 'length', 'max'=>128),
			array('order_add_time, order_update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ali_order_id, out_trade_no, buyer_id, buyer_email, seller_email, partner, trade_type_id, status_id, payment_type, price, quantity, logistics_payment, logistics_type, logistics_fee, subject, body, show_url, notify_url, return_url, receive_name, receive_zip, receive_address, receive_phone, receive_mobile, sign_type, sign, _input_charset, order_add_time, order_update_time', 'safe', 'on'=>'search'),
		); */
	  return array(
	      array('ali_order_id, out_trade_no, seller_email, partner, price, subject, notify_url, return_url, receive_name, receive_zip, receive_address, receive_mobile, sign', 'required'),
			  array('out_trade_no, trade_type_id, status_id, payment_type, quantity, receive_zip, receive_phone, receive_mobile', 'numerical', 'integerOnly'=>true),
	      array('buyer_email, seller_email, body, show_url, receive_address', 'length', 'max'=>100),
	      array('partner', 'length', 'max'=>32),
	      array('price, logistics_fee, subject', 'length', 'max'=>20),
	      array('logistics_payment, logistics_type, sign_type, _input_charset', 'length', 'max'=>16),
	      array('notify_url, return_url', 'length', 'max'=>160),
	      array('receive_name', 'length', 'max'=>50),
	      array('sign', 'length', 'max'=>128),
	      array('order_add_time, order_update_time', 'safe'),
	      // The following rule is used by search().
	      // @todo Please remove those attributes that should not be searched.
	      array('ali_order_id, out_trade_no, buyer_id, buyer_email, seller_email, partner, trade_type_id, status_id, payment_type, price, quantity, logistics_payment, logistics_type, logistics_fee, subject, body, show_url, notify_url, return_url, receive_name, receive_zip, receive_address, receive_phone, receive_mobile, sign_type, sign, _input_charset, order_add_time, order_update_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ali_order_id' => '订单号',
			'out_trade_no' => '商户交易号',
			'buyer_id' => 'Buyer',
			'buyer_email' => '用户邮箱',
			'seller_email' => '商户邮箱',
			'partner' => '商户ID',
			'trade_type_id' => '交易类型ID',
			'status_id' => '交易状态ID',
			'payment_type' => '支付类型',
			'price' => '交易价格',
			'quantity' => '交易商品数量',
			'logistics_payment' => '物流支付方式',
			'logistics_type' => '物流方式',
			'logistics_fee' => '物流费用',
			'subject' => '订单名称',
			'body' => '订单描述',
			'show_url' => '商品展示URL',
			'notify_url' => '异步通知接口',
			'return_url' => '同步通知接口',
			'receive_name' => '收货人姓名',
			'receive_zip' => '收货邮编',
			'receive_address' => '收货人地址',
			'receive_phone' => '收货人电话',
			'receive_mobile' => '收货人手机',
			'sign_type' => '签名方式',
			'sign' => '签名值',
			'_input_charset' => '编码方式',
			'order_add_time' => '下单时间',
			'order_update_time' => '上次更新时间',
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

		$criteria->compare('ali_order_id',$this->ali_order_id,true);
		$criteria->compare('out_trade_no',$this->out_trade_no);
		$criteria->compare('buyer_id',$this->buyer_id,true);
		$criteria->compare('buyer_email',$this->buyer_email,true);
		$criteria->compare('seller_email',$this->seller_email,true);
		$criteria->compare('partner',$this->partner,true);
		$criteria->compare('trade_type_id',$this->trade_type_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('payment_type',$this->payment_type);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('logistics_payment',$this->logistics_payment,true);
		$criteria->compare('logistics_type',$this->logistics_type,true);
		$criteria->compare('logistics_fee',$this->logistics_fee,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('show_url',$this->show_url,true);
		$criteria->compare('notify_url',$this->notify_url,true);
		$criteria->compare('return_url',$this->return_url,true);
		$criteria->compare('receive_name',$this->receive_name,true);
		$criteria->compare('receive_zip',$this->receive_zip);
		$criteria->compare('receive_address',$this->receive_address,true);
		$criteria->compare('receive_phone',$this->receive_phone);
		$criteria->compare('receive_mobile',$this->receive_mobile);
		$criteria->compare('sign_type',$this->sign_type,true);
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('_input_charset',$this->_input_charset,true);
		$criteria->compare('order_add_time',$this->order_add_time,true);
		$criteria->compare('order_update_time',$this->order_update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RawOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
