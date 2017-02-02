<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Bill',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
