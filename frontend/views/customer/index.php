<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::$app->name.' '.Yii::t('app', 'Customers');
$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;

	
//print_r ($searchModel);

?>


<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Customer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
    Mandant: <?= $mandator_active; ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			//'customer_number',
            'id',
            //'mandator_id',            
			//'address_id',
			'fullName',
			'email',
			//'orderAmount',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
