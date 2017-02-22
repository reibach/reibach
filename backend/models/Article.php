<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property string $name
 * @property string $unit
 * @property string $comment
 * @property double $price
 *
 * @property Mandator $mandator
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mandator_id', 'name'], 'required'],
            [['mandator_id'], 'integer'],
            [['comment'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 10],
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
            'name' => Yii::t('app', 'Name'),
            'unit' => Yii::t('app', 'Unit'),
            'comment' => Yii::t('app', 'Comment'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMandator()
    {
        return $this->hasOne(Mandator::className(), ['id' => 'mandator_id']);
    }
}
