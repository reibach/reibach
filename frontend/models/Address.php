<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $address_type
 * @property string $title
 * @property string $company
 * @property string $prename
 * @property string $lastname
 * @property string $zipcode
 * @property string $place
 * @property string $address1
 * @property string $address2
 * @property string $state
 * @property string $phone_privat
 * @property string $phone_business
 * @property string $phone_mobile
 * @property string $email
 * @property string $fax
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * @property CustomerAddress[] $customerAddresses
 * @property Mandator[] $mandators
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['address_type', 'title', 'company', 'prename', 'lastname', 'zipcode', 'place', 'address1', 'address2', 'state', 'phone_privat', 'phone_business', 'phone_mobile', 'email', 'fax', 'create_user_id', 'update_user_id'], 'required'],
            [['address_type'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['create_user_id', 'update_user_id'], 'integer'],
            [['title', 'company', 'prename', 'lastname', 'state', 'phone_privat', 'phone_business', 'phone_mobile', 'fax'], 'string', 'max' => 100],
            [['zipcode', 'place', 'address1', 'address2', 'email'], 'string', 'max' => 255],
        ];
    }


	/* Getter for person full name */
	public function getFullName() {
		return $this->prename . ' ' . $this->lastname;
	}


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address_type' => Yii::t('app', 'Address Type'),
            'title' => Yii::t('app', 'Title'),
            'company' => Yii::t('app', 'Company'),
            'prename' => Yii::t('app', 'Prename'),
            'lastname' => Yii::t('app', 'Lastname'),
			'fullName'=>Yii::t('app', 'Full Name'),
            'zipcode' => Yii::t('app', 'Zipcode'),
            'place' => Yii::t('app', 'Place'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'state' => Yii::t('app', 'State'),
            'phone_privat' => Yii::t('app', 'Phone Privat'),
            'phone_business' => Yii::t('app', 'Phone Business'),
            'phone_mobile' => Yii::t('app', 'Phone Mobile'),
            'email' => Yii::t('app', 'Email'),
            'fax' => Yii::t('app', 'Fax'),
            'create_time' => Yii::t('app', 'Create Time'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'update_time' => Yii::t('app', 'Update Time'),
            'update_user_id' => Yii::t('app', 'Update User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAddresses()
    {
        return $this->hasMany(CustomerAddress::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMandators()
    {
        return $this->hasMany(Mandator::className(), ['address_id' => 'id']);
    }
}
