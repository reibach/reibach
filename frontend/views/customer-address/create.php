<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CustomerAddress */

$this->title = Yii::t('app', 'Create Customer Address');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
