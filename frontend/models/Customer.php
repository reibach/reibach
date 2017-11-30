<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property integer $address_id
 * @property string $customer_number 
 * @property Bill[] $bills
 * @property Address $address
 * @property Mandator $mandator
 * @property CustomerAddress[] $customerAddresses
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mandator_id', 'address_id'], 'required'],
            [['mandator_id', 'address_id' ], 'integer'],
            [['customer_number'], 'safe'], 
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['mandator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mandator::className(), 'targetAttribute' => ['mandator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mandator_id' => Yii::t('app', 'Mandator ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'fullName'=>Yii::t('app', 'Full Name'),
            'email'=>Yii::t('app', 'EMail'),            
            'customer_number' => Yii::t('app', 'Customer Number'),
           	'orderAmount' => Yii::t('app', 'Order Amount'),
           	'offerAmount' => Yii::t('app', 'Offer Amount'),
        ];
    }

	public function getFullName()
	{
		return $this->address->fullName;
   	}

	public function getTestString()
	{
		return "METOO";
   	}

	public function getEmail()
	{
		return $this->address->email;
   	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMandator()
    {
        return $this->hasOne(Mandator::className(), ['id' => 'mandator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAddresses()
    {
        return $this->hasMany(CustomerAddress::className(), ['customer_id' => 'id']);
    }

	/**
	* Order amount for customer 
	*/
	public function getOrderAmount()
	{
		return $this->hasMany(Order::className(), ['customer_id' => 'id'])->sum('amount');
	}
}
