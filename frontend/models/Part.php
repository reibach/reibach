<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property integer $id
 * @property integer $offer_id
 * @property string $name
 * @property string $part_num
 * @property string $quantity
 * @property string $unit
 * @property string $comment
 * @property string $price
 * @property string $taxrate
 *
 * @property Offer $offer
 */
class Part extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['offer_id', 'name', 'quantity', 'price', 'taxrate'], 'required'],
            [['name',  'taxrate'], 'required'],
            [['offer_id'], 'integer'],
            [['quantity', 'price', 'taxrate'], 'number'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['part_num'], 'string', 'max' => 2],
            [['unit'], 'string', 'max' => 10],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'offer_id' => Yii::t('app', 'Offer ID'),
            'name' => Yii::t('app', 'Name'),
            'part_num' => Yii::t('app', 'Part Num'),
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
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
}
