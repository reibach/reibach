<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property integer $address_id
 * @property string $customer_number
 *
 * @property Bill[] $bills
 * @property Mandator $mandator
 * @property Address $address
 * @property CustomerAddress[] $customerAddresses
 * @property Offer[] $offers
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
            [['mandator_id', 'address_id'], 'integer'],
            [['customer_number'], 'string', 'max' => 150],
            [['mandator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mandator::className(), 'targetAttribute' => ['mandator_id' => 'id']],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
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
            'customer_number' => Yii::t('app', 'Customer Number'),
        ];
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
    public function getMandator()
    {
        return $this->hasOne(Mandator::className(), ['id' => 'mandator_id']);
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
    public function getCustomerAddresses()
    {
        return $this->hasMany(CustomerAddress::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['customer_id' => 'id']);
    }
}
