<?php

use yii\helpers\Html;
use yii\grid\GridView;
Yii::$app->formatter->locale = 'de-DE';

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Positions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Position'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bill_id',
            'name',
            'pos_num',
            'quantity:decimal',
            // 'unit',
            // 'comment:ntext',
            // 'price',
            // 'tax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
