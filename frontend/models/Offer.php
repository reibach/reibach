<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property integer $mandator_id
 * @property integer $customer_id
 * @property string $description
 * @property double $status
 * @property string $offer_number
 * @property string $offer_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customer $customer
 * @property Mandator $mandator
 * @property OfferPosition[] $offerPositions
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mandator_id', 'customer_id', 'offer_date', 'created_at', 'updated_at'], 'required'],
            [['mandator_id', 'customer_id'], 'integer'],
            [['description'], 'string'],
            [['status'], 'number'],
            [['offer_date', 'created_at', 'updated_at'], 'safe'],
            [['offer_number'], 'string', 'max' => 150],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
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
            'customer_id' => Yii::t('app', 'Customer ID'),
            'fullName' => Yii::t('app', 'Full Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
  			'positionPrice' => Yii::t('app', 'Position Price'),
  			'totalPosPrice' => Yii::t('app', 'Total'),
            'status' => Yii::t('app', 'Status'),
            'offer_number' => Yii::t('app', 'Offer Number'),
            'offer_date' => Yii::t('app', 'Offer Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
	public function getFullName()
	{
		return $this->customer->fullName;
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
    public function getMandator()
    {
        return $this->hasOne(Mandator::className(), ['id' => 'mandator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferPositions()
    {
        return $this->hasMany(OfferPosition::className(), ['order_id' => 'id']);
    }
    
    // ####################################
    
        /**
	* Position Price for bill 
	*/
	public function getPositionPrices()
	{
		return $this->hasMany(Position::className(), ['bill_id' => 'id'])->sum('price');
	}

    /**
	* Get Teststring for bill 
	*/
	public function getTestString()
	{
		$testString = "test me again";
		return $this->$testSTring;
	}

    /**
	* Get Teststring for bill with ID
	*/
	public function getTestStringId($id)
	{
		$testString = "test me again with ID:".$id;
		return $this->$testString;
	}




 /* Getter for TotalBillPrice 
  * ist die Summe aller EinzelPositionen  
  * */

function getBillTotal($id) {

	// Gesamtpreis der Positionen der jeweiligen Rechnung ermitteln und aufsummieren		
	$searchModel = new PositionSearch();
	$dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);        

	foreach($dataProvider->models as $myModel){				
		$taxrate = $myModel->taxrate / 100;
		$taxrate = $taxrate + 1; 		
		$myTotalPosPrice[] =  $myModel->quantity * $myModel->price * $taxrate;			
	} 

	$billTotal = round(array_sum($myTotalPosPrice), 2);
	//$billTotal = round($myTotalPosPrice, 2);
	//return $myTotalPosPrice;	
	//print_r($myTotalPosPrice);	
	
	$billPrice[] =  $billTotal;
	
	//echo "<p>EEESSEEET</p>";


	$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
	//echo "<p>getbillTotal Gesamtpreis ALLER Positionen: <b>".$billPrice."</b></p>";

	return $billPrice;
}	


 /* Getter for TotalBillPrice 
  * ist die Summe aller EinzelPositionen  
  * */
	//public function getBillTotal() {
		// steuersatz umrechnen
		//$tax = $this->tax / 100;
		//$tax = $tax + 1; 

		//return $this->quantity * $this->price * $tax;
	//}

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


	public function getBillPriceMe() {
		return $this->BillPrice;
	}	
	

	public function getBillPrice() {

		// Gesamtpreis der Positionen der jeweiligen Rechnung 
		$myTotalPosPrice = array();

		// Gesamtpreis aller Rechnungen
		$billPrice = array();

		$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
		foreach($dataProvider->models as $myModel){
					
			// alle IDs der Rechnungen dieses Mandanten ausgeben		
			//print $myModel->id;
			//print "<br>";
			$id = $myModel->id;
			
			// Gesamtpreis der Positionen der jeweiligen Rechnung ermitteln und aufsummieren		
			$searchModel = new PositionSearch();
			$dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);        

			foreach($dataProvider->models as $myModel){				
				$taxrate = $myModel->taxrate / 100;
				$taxrate = $taxrate + 1; 		
				$myTotalPosPrice[] =  $myModel->quantity * $myModel->price * $taxrate;			
				//print_r($myTotalPosPrice);
				//print "<br>";
			} 

			$billTotal = round(array_sum($myTotalPosPrice), 2);
			//$billTotal = round($myTotalPosPrice, 2);
			unset($myTotalPosPrice);
			echo "<h3>Gesamtpreis der jeweiligen Rechnung mit ID: ".$id.": ".Yii::$app->formatter->asDecimal($billTotal)."</h3>";	
			
			$billPrice[] =  $billTotal;
		} 

		$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
		echo "<h3>Gesamtpreis ALLER Rechnungen: ".$billPrice."</h3>";
	}

    
    // ####################################
    
}
