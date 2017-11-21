<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property integer $bill_id
 * @property string $name
 * @property string $pos_num
 * @property string $quantity
 * @property string $unit
 * @property string $comment
 * @property string $price
 * @property string $taxrate
 *
 * @property Bill $bill
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['bill_id', 'name'], 'required'],
		//[['bill_id', 'name', 'quantity'], 'required'],
            //[[ 'name', 'quantity'], 'required'],
            [['bill_id'], 'integer'],
            
            [['taxrate'], 'number', 'max'=>0],
            
            //[['quantity', 'price', 'taxrate'], 'number'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['pos_num'], 'string', 'max' => 2],
            [['unit'], 'string', 'max' => 10],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['bill_id' => 'id']],
            ['price', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
            ['quantity', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
            ['taxrate', 'filter', 'filter' => function ($value) {$value = str_replace(',', '.', $value); return $value; }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bill_id' => Yii::t('app', 'Bill ID'),
            'name' => Yii::t('app', 'Name'),
            'pos_num' => Yii::t('app', 'Pos Num'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit' => Yii::t('app', 'Unit'),
            'comment' => Yii::t('app', 'Comment'),
            'price' => Yii::t('app', 'Price'),
            'totalPosPrice' => Yii::t('app', 'TotalPosPrice'),
            'taxrate' => Yii::t('app', 'Taxrate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bill::className(), ['id' => 'bill_id']);
    }
    
     /* Getter for TotalBillPrice 
  * ist die Summe der Preise * Anzahl zu Steuersatz aller EinzelPositionen  einer Rechnung
  * */
	public function getBillTotal() {
		// alle Positionen einer Rechnungen ermitteln 
		
		// und den Positionspreis errechnen und speichern
		
		// die Summe aller Positionspreise ist der Rechnungspreis
		
		
		// steuersatz umrechnen
		//$tax = $this->tax / 100;
		//$tax = $tax + 1; 
		return $this->quantity * $this->price * $tax;
	}

    
   /* Getter for TotalPrice */
	public function getTotalPosPrice() {
		// steuersatz umrechnen
		$taxrate = $this->taxrate / 100;
		$taxrate = $taxrate + 1; 
		return $this->quantity * $this->price * $taxrate;
	}
}
