<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "offer_position".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property string $pos_num
 * @property string $quantity
 * @property string $unit
 * @property string $comment
 * @property string $price
 * @property string $taxrate
 *
 * @property Offer $order
 */
class OfferPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'name', 'quantity', 'price', 'taxrate'], 'required'],
            [['order_id'], 'integer'],
            [['quantity', 'price', 'taxrate'], 'number'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['pos_num'], 'string', 'max' => 2],
            [['unit'], 'string', 'max' => 10],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'name' => Yii::t('app', 'Name'),
            'pos_num' => Yii::t('app', 'Pos Num'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit' => Yii::t('app', 'Unit'),
            'comment' => Yii::t('app', 'Comment'),
            'price' => Yii::t('app', 'Price'),
            'taxrate' => Yii::t('app', 'Taxrate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Offer::className(), ['id' => 'order_id']);
    }
}
