<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
Yii::$app->formatter->locale = 'de-DE';



/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-view">

        <h1><?= Yii::t('app', 'Bill').": &nbsp;".Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h4><?= Yii::t('app', 'Mandator') ?>:&nbsp;
	<?= $address_mandator['prename'], $address_mandator['lastname'] ?>
	</h4>
	<?= $address_mandator['fullName'] ?>
	</h4>


    <h4><?= Yii::t('app', 'Customer') ?>:&nbsp;
    <?= $customer['fullName'] ?>
    </h4>

    <h1><?= Yii::t('app', 'Positions') ?></h1>

<?php
//Yii::$app->formatter->locale = 'de-DE';
//echo Yii::$app->formatter->asDecimal('23.55'); // output: 1. Januar 2014
?>
<?php
// <?= //$this->price = yii::$app->formatter->asDecimal($this->price,2); ?>
    <?= GridView::widget([
		//Yii::$app->formatter->locale = 'de-DE',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'pos_num',
            //'id',
            //'bill_id',
            'name',
             'unit',
            'quantity:decimal',
            'price:decimal',
             'comment:ntext',
             //Yii::$app->formatter->asDecimal('price'),
             'taxrate:decimal',
             'totalPosPrice:decimal',
             //'totalPrice:decimal',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
//print_r($dataProvider->price[]);

   
//foreach( $dataProvider->id as $myModel){
    //print_r ($myModel);
    //echo $myModel->quantity;

 //} 


// Gesamtpreis aller Rechungspositionen ermitteln und ausgeben
$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
$myTotalPosPrice = array();

foreach($dataProvider->models as $myModel){
			
	$taxrate = $myModel->taxrate / 100;
	$taxrate = $taxrate + 1; 		
	$myTotalPosPrice[] =  $myModel->quantity * $myModel->price * $taxrate;
			
} 

//Yii::$app->formatter->asDecimal($model->bill['price'])
//echo "sum(a) = " . array_sum($myTotalPosPrice) . "\n";
//echo "sum(a) = " . round(array_sum($myTotalPosPrice), 2) . "\n";
//echo "sum(a) = " . Yii::$app->formatter->asDecimal(round(array_sum($myTotalPosPrice), 2)) . "\n";
$billTotal = Yii::$app->formatter->asDecimal(round(array_sum($myTotalPosPrice), 2)) . "\n";
echo "<h3>Gesamtpreis: ".$billTotal."</h3>"



?>    


        
<?php 
	/**
	 * THE VIEW BUTTON
	 */
	 $desc = Yii::t('app', 'Print PDF');
	 echo Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> '.$desc, ['/bill/report', 'id' => $model->id], [
		'class'=>'btn btn-danger', 
		'target'=>'_blank', 
		'data-toggle'=>'tooltip', 
		'title'=>'Will open the generated PDF file in a new window'
	]);
?>

<?php 
	/**
	 * THE Html VIEW BUTTON
	 */
	 $desc = Yii::t('app', 'Print PDF-Preview');
	 echo Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> '.$desc, ['/bill/reporthtml', 'id' => $model->id], [
		'class'=>'btn btn-danger', 
		'target'=>'_blank', 
		'data-toggle'=>'tooltip', 
		'title'=>'Will open the generated PDF file in a new window'
	]);
?>

</div>
