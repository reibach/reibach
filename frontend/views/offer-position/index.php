<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OfferPositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Offer Positions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-position-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Offer Position'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            'name',
            'pos_num',
            'quantity',
            // 'unit',
            // 'comment:ntext',
            // 'price',
            // 'taxrate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
