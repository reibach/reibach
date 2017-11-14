<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property integer $customer_id
 * @property string $description
 * @property double $status
 * @property string $offer_number
 * @property string $offer_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer $customer
 * @property Mandator $mandator
 * @property OfferPosition[] $offerPositions
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mandator_id', 'customer_id', 'offer_date', 'created_at', 'updated_at'], 'required'],
            [['mandator_id', 'customer_id'], 'integer'],
            [['description'], 'string'],
            [['status'], 'number'],
            [['offer_date', 'created_at', 'updated_at'], 'safe'],
            [['offer_number'], 'string', 'max' => 150],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'offer_number' => Yii::t('app', 'Offer Number'),
            'offer_date' => Yii::t('app', 'Offer Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
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
    public function getOfferPositions()
    {
        return $this->hasMany(OfferPosition::className(), ['order_id' => 'id']);
    }
}
