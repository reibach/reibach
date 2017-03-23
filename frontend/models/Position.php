<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property integer $bill_id
 * @property string $name
 * @property string $pos_num
 * @property string $quantity
 * @property string $unit
 * @property string $comment
 * @property string $price
 * @property string $tax
 *
 * @property Bill $bill
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_id', 'name'], 'required'],
            [['bill_id'], 'integer'],
            [['quantity', 'price', 'tax'], 'number'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['pos_num'], 'string', 'max' => 2],
            [['unit'], 'string', 'max' => 10],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['bill_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bill_id' => Yii::t('app', 'Bill ID'),
            'name' => Yii::t('app', 'Name'),
            'pos_num' => Yii::t('app', 'Pos Num'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit' => Yii::t('app', 'Unit'),
            'comment' => Yii::t('app', 'Comment'),
            'price' => Yii::t('app', 'Price'),
            'tax' => Yii::t('app', 'Tax'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bill::className(), ['id' => 'bill_id']);
    }
}
