<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bill', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'mandator_id',
            'name:ntext',
            'description:ntext',
            // 'price',
            // 'status',
            // 'billdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
