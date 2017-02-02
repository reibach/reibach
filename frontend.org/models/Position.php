<?php

namespace frontend\models;

use \yii\db\ActiveRecord;;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property integer $bill_id
 * @property string $pos_num
 * @property double $quantity
 * @property string $unit
 * @property string $name
 * @property string $comment
 * @property double $price
 * @property double $tax
 * @property double $amount
 *
 * @property Bill $bill
 */
class Position extends ActiveRecord
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
            //[['bill_id', 'name'], 'required'],
            //[['bill_id'], 'integer'],
            //[['quantity', 'price', 'tax', 'amount'], 'number'],
            //[['comment'], 'string'],
            //[['pos_num'], 'string', 'max' => 20],
            //[['unit'], 'string', 'max' => 10],
            //[['name'], 'string', 'max' => 255],
            //[['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['bill_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_id' => 'Bill ID',
            'pos_num' => 'Pos Num',
            'quantity' => 'Quantity',
            'unit' => 'Unit',
            'name' => 'Name',
            'comment' => 'Comment',
            'price' => 'Price',
            'tax' => 'Tax',
            'amount' => 'Amount',
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
