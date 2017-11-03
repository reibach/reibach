<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mandator".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $address_id
 * @property text $signatiure
 *
 * @property Article[] $articles
 * @property Customer[] $customers
 * @property Address $address
 * @property User $user
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
            //[['user_id', 'address_id'], 'required'],
            [['user_id'], 'required'],
            [['user_id', 'address_id', 'taxable', 'b_id', 'c_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'address_id' => Yii::t('app', 'Address ID'),
            'prename' => Yii::t('app', 'prename'),
			'fullName'=>Yii::t('app', 'Full Name'),
			'taxable' => Yii::t('app', 'Taxable'),
			'b_id' => Yii::t('app', 'B ID'),
		    'c_id' => Yii::t('app', 'C ID'),
		    'signature' => Yii::t('app', 'Signature'),
		    
        ];
    }


	/*********
	// Standard-Mandanten laden
	public function getDefaultMandator()
	{
		$mandator = new Mandator();
		//$session = Yii::$app->session;
		//$mandator_active = $session->get('mandator_active');
		
		$query = Mandator::find()->andWhere(['user_id' => Yii::$app->user->id]);

        foreach ($query->all() as $act_man) {
            print "<p></p>";
            print $act_man;
            print "<p></p>";
        }        
        return true;
		//return $this->address->fullName;
   	}
	****/

	 /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultMandator($id)
    {
        return $this->hasOne(Mandator::className(), ['id' => $id]);
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
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    

}
