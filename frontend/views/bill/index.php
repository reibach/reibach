<?php

use yii\helpers\Html;
use yii\grid\GridView;

use frontend\models\Bill;
use frontend\models\Position;
use frontend\models\PositionSearch;


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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'customer_id',
            'fullName',
            //'description:ntext',
            'status',
            'positionPrice',
            //'billTotal',
            //'fullName's,
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php
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
	
	$meetoo = getbillTotal($bill_id);
	//echo $meetoo;
	//print_r($meetoo);
    //echo "Schlüssel: ".$key; 
    //echo "Wert: ".$value."<br />\n";
}	



function getbillTotal($id) {

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
	print_r($myTotalPosPrice);	
	
	$billPrice[] =  $billTotal;
	
	echo "<p></p>";


$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
echo "<p>Gesamtpreis ALLER Rechnungen: <b>".$billPrice."</b></p>";
}	


foreach($dataProvider->models as $myModel){
			
	// alle IDs der Rechnungen dieses Mandanten ausgeben		
	//print $myModel->id;
	//print "<br>";
	$id = $myModel->id;
	$customer_id = $myModel->customer_id;
	
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

	echo "Rechnungs-ID: ".$id;
	echo "&nbsp;Kunde: $customer_id"; 
	
	//echo "<h3>Gesamtpreis der jeweiligen Rechnung mit ID: ".$id.": ".Yii::$app->formatter->asDecimal($billTotal)."</h3>";	
	echo "&nbsp; Gesamtpreis: <b>".Yii::$app->formatter->asDecimal($billTotal)."</b><br>";	
	
	$billPrice[] =  $billTotal;
} 

$billPrice = $billTotal = Yii::$app->formatter->asDecimal(round(array_sum($billPrice), 2));
echo "<p>Gesamtpreis ALLER Rechnungen: <b>".$billPrice."</b></p>";
?>

<?php
// <?= 
 //GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'customer_id',
            //'fullName',
            //'description:ntext',
            //'status',
            //'positionPrice',
			//$billTotal,
            //['class' => 'yii\grid\ActionColumn'],
        //],
    //]); 
// ?>
?>
