<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_on
 * @property string $details
 * @property string $amount
 * @property integer $customer_id
 *
 * @property Customer $customer
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_on', 'amount'], 'required'],
            [['created_on'], 'safe'],
            [['amount'], 'number'],
            [['customer_id'], 'integer'],
            [['details'], 'string', 'max' => 200],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'details' => Yii::t('app', 'Details'),
            'amount' => Yii::t('app', 'Amount'),
            'customer_id' => Yii::t('app', 'Customer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
