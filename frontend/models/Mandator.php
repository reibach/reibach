<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mandator".
 *
 * @property integer $id
 * @property string $mandator_name
 * @property integer $user_id
 * @property integer $address_id
 * @property integer $taxable
 * @property integer $b_id
 * @property integer $c_id
 * @property string $signature
 *
 * @property Article[] $articles
 * @property Bill[] $bills
 * @property Customer[] $customers
 * @property User $user
 * @property Address $address
 */
class Mandator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mandator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           //  [['mandator_name', 'user_id', 'address_id', 'signature'], 'required'],
            [['user_id', 'address_id', 'taxable', 'b_id', 'c_id'], 'integer'],
            [['signature'], 'string'],
            [['mandator_name'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mandator_name' => Yii::t('app', 'Mandator Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'taxable' => Yii::t('app', 'Taxable'),
            'b_id' => Yii::t('app', 'B ID'),
            'c_id' => Yii::t('app', 'C ID'),
            'signature' => Yii::t('app', 'Signature'),
        ];
    }
	// Vor- und Nachname zusammensetzen
	public function getFullName()
	{
		return $this->address->fullName;
   	}
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['mandator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['mandator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['mandator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
}
