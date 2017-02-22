<?php

namespace frontend\models;
//use \yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Parcel[] $parcels
 */
class Product extends \yii\db\ActiveRecord
//class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParcels()
    {
        return $this->hasMany(Parcel::className(), ['product_id' => 'id']);
    }
}
