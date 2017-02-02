<?php
namespace frontend\models;
//use frontend\models\Position;
use Yii;

//use yii\db\ActiveRecord;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $description
 * @property double $price
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
            //[['customer_id'], 'required'],
            [['customer_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['price', 'status'], 'number'],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['positions'], 'safe'],
            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
}
