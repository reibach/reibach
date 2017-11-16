<?php

namespace frontend\models;
use frontend\models\Customer;

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
 * @property Part[] $parts
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
            //[['mandator_id', 'customer_id', 'offer_date', 'created_at', 'updated_at'], 'required'],
            [['customer_id', 'offer_date'], 'required'],
            //[['mandator_id', 'customer_id'], 'integer'],
            //[['description'], 'string'],
            //[['status'], 'number'],
            //[['offer_date', 'created_at', 'updated_at'], 'safe'],
            //[['offer_number'], 'string', 'max' => 150],
            //[['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            //[['mandator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mandator::className(), 'targetAttribute' => ['mandator_id' => 'id']],
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
  			'partPrice' => Yii::t('app', 'Part Price'),
  			'totalPartPrice' => Yii::t('app', 'Total'),
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
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['offer_id' => 'id']);
    }
    
        /**
	* Part Price for bill 
	*/
	public function getPartPrices()
	{
		return $this->hasMany(Part::className(), ['bill_id' => 'id'])->sum('price');
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




 /* Getter for TotalPartPrice 
  * ist die Summe aller Einzelteile  
  * */

function getOfferTotal($id) {

	// Gesamtpreis der Angebotsteile des jeweiligen ANgebots ermitteln und aufsummieren		
	$searchModel = new PartSearch();
	$dataProvider = $searchModel->searchBillPart(Yii::$app->request->queryParams, $id);        

	foreach($dataProvider->models as $myModel){				
		$taxrate = $myModel->taxrate / 100;
		$taxrate = $taxrate + 1; 		
		$myTotalPartPrice[] =  $myModel->quantity * $myModel->price * $taxrate;			
	} 

	$billTotal = round(array_sum($myTotalPartPrice), 2);
	//$billTotal = round($myTotalPartPrice, 2);
	//return $myTotalPartPrice;	
	//print_r($myTotalPartPrice);	
	
	$billPrice[] =  $billTotal;
	
	//echo "<p>EEESSEEET</p>";


	$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
	//echo "<p>getbillTotal Gesamtpreis ALLER Angebotsteile: <b>".$offerPrice."</b></p>";

	return $billPrice;
}	


 /* Getter for TotalOfferPrice 
  * ist die Summe aller EinzelParten  
  * */
	//public function getOfferTotal() {
		// steuersatz umrechnen
		//$tax = $this->tax / 100;
		//$tax = $tax + 1; 

		//return $this->quantity * $this->price * $tax;
	//}

    /**
	* Part Price for bill 
	*/
	public function getPartPrice()
	{
		return $this->hasMany(Part::className(), ['bill_id' => 'id'])
			//->sum('quantity')
			->sum('price');
		}

	public function getPartPriceaaa()
	{
		return $this->hasMany(Part::className(), ['bill_id' => 'id'])
			//->sum('quantity')
			->sum('price');
		}


	public function getOfferPriceMe() {
		return $this->OfferPrice;
	}	
	

	public function getOfferPrice() {

		// Gesamtpreis der Parten der jeweiligen Rechnung 
		$myTotalPartPrice = array();

		// Gesamtpreis aller Rechnungen
		$billPrice = array();

		$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
		foreach($dataProvider->models as $myModel){
					
			// alle IDs der Rechnungen dieses Mandanten ausgeben		
			//print $myModel->id;
			//print "<br>";
			$id = $myModel->id;
			
			// Gesamtpreis der Parten der jeweiligen Rechnung ermitteln und aufsummieren		
			$searchModel = new PartSearch();
			$dataProvider = $searchModel->searchOfferPart(Yii::$app->request->queryParams, $id);        

			foreach($dataProvider->models as $myModel){				
				$taxrate = $myModel->taxrate / 100;
				$taxrate = $taxrate + 1; 		
				$myTotalPartPrice[] =  $myModel->quantity * $myModel->price * $taxrate;			
				//print_r($myTotalPartPrice);
				//print "<br>";
			} 

			$billTotal = round(array_sum($myTotalPartPrice), 2);
			//$billTotal = round($myTotalPartPrice, 2);
			unset($myTotalPartPrice);
			echo "<h3>Gesamtpreis der jeweiligen Rechnung mit ID: ".$id.": ".Yii::$app->formatter->asDecimal($billTotal)."</h3>";	
			
			$billPrice[] =  $billTotal;
		} 

		$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
		echo "<h3>Gesamtpreis ALLER Rechnungen: ".$billPrice."</h3>";
	}

    
    // ####################################
    
}
