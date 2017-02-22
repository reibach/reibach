<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $abo_start
 * @property integer $abo_end
 * @property integer $abo_turn
 * @property string $abo_type
 *
 * @property Mandator[] $mandators
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'abo_start', 'abo_end', 'abo_turn', 'abo_type'], 'required'],
            [['status', 'created_at', 'updated_at', 'abo_start', 'abo_end', 'abo_turn'], 'integer'],
            [['abo_type'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'abo_start' => Yii::t('app', 'Abo Start'),
            'abo_end' => Yii::t('app', 'Abo End'),
            'abo_turn' => Yii::t('app', 'Abo Turn'),
            'abo_type' => Yii::t('app', 'Abo Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMandators()
    {
        return $this->hasMany(Mandator::className(), ['user_id' => 'id']);
    }
}
