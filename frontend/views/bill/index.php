<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'customer_id',
            'description:ntext',
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
/***
// Gesamtpreis aller Rechungspositionen ermitteln und ausgeben
$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
$myTotalPosPrice = array();

foreach( $dataProvider->models as $myModel){
			
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


***/
?>
