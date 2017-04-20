<?php
namespace frontend\models;
use frontend\models\Customer;
use Yii;

//use yii\db\ActiveRecord;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property integer $customer_id
 * @property string $description
 * @property double $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Customer $customer
 * @property Position[] $positions
 */
class Bill extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['status', 'customer_id', 'description'], 'required'],
            [['customer_id'], 'required'],
            //[['customer_id','mandator_id', 'created_at', 'updated_at'], 'integer'],
            //[['description','fullName'], 'string'],
            //[['description'], 'string'],
            //[['status'], 'number'],
            //[[ 'status'], 'number'],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            //[['positions'], 'safe'],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer'),
            'mandator_id' => Yii::t('app', 'Mandator'),
            //'fullName' => Yii::t('app', 'Full Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
  			'positionPrice' => Yii::t('app', 'Position Price'),
			'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
	 
	
	public function getFullName()
	{
		return $this->Customer->fullName;
   	}


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['bill_id' => 'id']);
    }
    
    /**
	* Position Price for bill 
	*/
	public function getPositionPrices()
	{
		return $this->hasMany(Position::className(), ['bill_id' => 'id'])->sum('price');
	}


 /* Getter for TotalBillPrice 
  * ist die Summe aller EinzelPositionen  
  * */
	public function getBillTotal() {
		// steuersatz umrechnen
		//$tax = $this->tax / 100;
		//$tax = $tax + 1; 
		return $this->quantity * $this->price * $tax;
	}

    /**
	* Position Price for bill 
	*/
	public function getPositionPrice()
	{
		return $this->hasMany(Position::className(), ['bill_id' => 'id'])
			//->sum('quantity')
			->sum('price');
		}

	public function getPositionPriceaaa()
	{
		return $this->hasMany(Position::className(), ['bill_id' => 'id'])
			//->sum('quantity')
			->sum('price');
		}
}
