<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adr".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 */
class Adr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
