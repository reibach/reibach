<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = Yii::t('app', 'Mailfile {modelClass}: ', [
    'modelClass' => 'Bill',
]) . $model->bill->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bill->id, 'url' => ['view', 'id' => $model->bill->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Mailfile');
?>
<div class="bill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEMail', [
        'model' => $model,
        'customer' => $customer,        
    ]) ?>

</div>
