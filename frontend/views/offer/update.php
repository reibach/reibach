<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offer */

$titlemeta = $this->title = Yii::t('app', 'Update Offer: ', [
    'modelClass' => 'Offer',
]) . $model->offer->id;

$this->title = Yii::$app->name.' '.Yii::t('app', 'Update Offer: ', [
    'modelClass' => 'Offer',
]) . $model->offer->id;



$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->offer->id, 'url' => ['view', 'id' => $model->offer->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="offer-update">

    <h1><?= Html::encode($titlemeta) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
