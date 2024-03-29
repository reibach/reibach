<?php

use yii\helpers\Html;
use yii\grid\GridView;

use frontend\models\Bill;
use frontend\models\Position;
use frontend\models\PositionSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bill'), ['create'], ['class' => 'btn btn-success']) ?>
 
 
    </p>

<?php
    //print_r($dataProvider);
    //print_r($searchModel);

	//foreach ($dataProvider as $value) {
    //print_r($value);
//}

//print_r($dataProvider->id);



//foreach( $dataProvider->id as $myModel){
    //print_r ($myModel);
    //echo $myModel->quantity;

 //} 

//exit;
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'customer_id',
            'fullName',
            'billing_date',
            //'description:ntext',
            //'status',
            //['value' => function ($data) {return $data->getbillTotal(ArrayHelper::getValue('', ''));}, 'label' => 'Toootal'],
      
            //'totalPosPrice:decimal',
            //'positionPrice',
            //'billTotal',
            //'fullName's,
            // 'created_at',
             //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php


// Gesamtpreis aller Rechnungen nur bei schon vorhandenen/r Rechnung/en moeglich 
$billExist = 0;

//print_r($dataProvider);
//print_r($searchModel);
//print_r($dataProvider->bill_id);



//if ($billExist == 0) {
	//print "ID ist NIX"; 
//} else {
	//print "ID ist: ".$billExist; 
//}

//print_r($dataProvider);
//print_r($searchModel);


//print_r($dataProvider->models[0]->id);



if (isset($dataProvider->models[0]->id)) {
	$myID = $dataProvider->models[0]->id;
	$data = '';
}


function getData() {
	return $data->getbillTotal($myID);
}

//print "TEST: ".$data;
//print "TEST: ".$myID;



foreach($dataProvider->models as $myModel){
			
	// alle IDs der Rechnungen dieses Mandanten ausgeben		
	//print $myModel->id;
	//print "<br>";
	$id = $myModel->id;
	$customer_id = $myModel->customer_id;
	$customer_name = $myModel->fullName;
	
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

	//$billTotal = round(array_sum($myTotalPosPrice), 2);
	//$billTotal = round($myTotalPosPrice, 2);
	unset($myTotalPosPrice);

	//echo "Rechnungs-ID: ".$id;
	//echo "&nbsp;Kunde: $customer_id"; 
	
	//echo "<h3>Gesamtpreis der jeweiligen Rechnung mit ID: ".$id.": ".Yii::$app->formatter->asDecimal($billTotal)."</h3>";	
	// echo "Rechnungsnummer: ".$id."&nbsp; Kundenname: ".$customer_name."&nbsp;Rechnungsbetrag: <b>".Yii::$app->formatter->asDecimal($billTotal)."</b><br>";	
	
	//$billPrice[] =  $billTotal;
} 

//$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
//echo "<p>Gesamtpreis ALLER Rechnungen: <b>".$billPrice."</b></p>";





//getbillTotal(99);
// $metoo = $dataProvider->models->getTestString();


// echo $metoo;

// Gesamtpreis der Positionen der jeweiligen Rechnung 
$myTotalPosPrice = array();

// Gesamtpreis aller Rechnungen
$billPrice = array();

$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
//foreach( as $myModel){
foreach ($dataProvider->models as $key => $value) {
	//print_r ($key);
	$bill_id = $value->id;
	//print_r($bill_id);
	
	//$meetoo = getBillTotal($bill_id);
	//echo $meetoo;
	//print_r($meetoo);
    //echo "Schlüssel: ".$key; 
    //echo "Wert: ".$value."<br />\n";
    //print_r ($key);
    //echo  "<p></p>"; 
    //print_r($value['customer_id']);
}	

//print_r($dataProvider->models[0]->customer_id);



?>

