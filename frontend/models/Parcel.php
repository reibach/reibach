<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "parcel".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $code
 * @property integer $height
 * @property integer $width
 * @property integer $depth
 *
 * @property Product $product
 */
class Parcel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parcel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['product_id', 'code', 'height', 'width', 'depth'], 'required'],
            [['code', 'height', 'width', 'depth'], 'required'],
            [['product_id', 'height', 'width', 'depth'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [['product_id'], 'exist', 
              'skipOnError' => true, 
              'targetClass' => Product::className(), 
              'targetAttribute' => ['product_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'code' => Yii::t('app', 'Code'),
            'height' => Yii::t('app', 'Height'),
            'width' => Yii::t('app', 'Width'),
            'depth' => Yii::t('app', 'Depth'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
