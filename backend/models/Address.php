<?php

namespace backend\models;

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
 * @property string $street
 * @property string $housenumber
 * @property string $state
 * @property string $phone_privat
 * @property string $phone_business
 * @property string $phone_mobile
 * @property string $email
 * @property string $internet
 * @property string $fax
 * @property string $bank_name
 * @property string $bank_account
 * @property string $bank_codenumber
 * @property string $iban
 * @property string $bic
 * @property string $tax_office
 * @property string $tax_number
 * @property string $vat_number
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * @property Customer[] $customers
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
            [['address_type', 'title', 'company', 'prename', 'lastname', 'zipcode', 'place', 'street', 'housenumber', 'state', 'phone_privat', 'phone_business', 'phone_mobile', 'email', 'internet', 'fax', 'bank_name', 'bank_account', 'bank_codenumber', 'iban', 'bic', 'tax_office', 'tax_number', 'vat_number', 'create_user_id', 'update_user_id'], 'required'],
            [['address_type'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['create_user_id', 'update_user_id'], 'integer'],
            [['title', 'company', 'prename', 'lastname', 'state', 'phone_privat', 'phone_business', 'phone_mobile', 'fax'], 'string', 'max' => 100],
            [['zipcode', 'place', 'street', 'housenumber', 'email'], 'string', 'max' => 255],
            [['internet', 'bank_name', 'bank_codenumber', 'iban', 'tax_office', 'tax_number', 'vat_number'], 'string', 'max' => 27],
            [['bank_account'], 'string', 'max' => 50],
            [['bic'], 'string', 'max' => 12],
        ];
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
            'zipcode' => Yii::t('app', 'Zipcode'),
            'place' => Yii::t('app', 'Place'),
            'street' => Yii::t('app', 'Street'),
            'housenumber' => Yii::t('app', 'Housenumber'),
            'state' => Yii::t('app', 'State'),
            'phone_privat' => Yii::t('app', 'Phone Privat'),
            'phone_business' => Yii::t('app', 'Phone Business'),
            'phone_mobile' => Yii::t('app', 'Phone Mobile'),
            'email' => Yii::t('app', 'Email'),
            'internet' => Yii::t('app', 'Internet'),
            'fax' => Yii::t('app', 'Fax'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'bank_account' => Yii::t('app', 'Bank Account'),
            'bank_codenumber' => Yii::t('app', 'Bank Codenumber'),
            'iban' => Yii::t('app', 'Iban'),
            'bic' => Yii::t('app', 'Bic'),
            'tax_office' => Yii::t('app', 'Tax Office'),
            'tax_number' => Yii::t('app', 'Tax Number'),
            'vat_number' => Yii::t('app', 'Vat Number'),
            'create_time' => Yii::t('app', 'Create Time'),
            'create_user_id' => Yii::t('app', 'Create User ID'),
            'update_time' => Yii::t('app', 'Update Time'),
            'update_user_id' => Yii::t('app', 'Update User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['address_id' => 'id']);
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
