<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mandator_id',
            'customer_id',
            'description:ntext',
            'status',
            'offer_number',
            'offer_date',
            'created_at',
            'updated_at',
        ],
    ]) ?>

 <?= Html::a(Yii::t('app', 'Mutate'), ['mutate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
 <?= Html::a(Yii::t('app', 'Preview'), ['reporthtml', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
</div>
