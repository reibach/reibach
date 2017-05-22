<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Address',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
