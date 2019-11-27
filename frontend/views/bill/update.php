<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Bill',
]) . $model->bill->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bill->id, 'url' => ['view', 'id' => $model->bill->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bill-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mandator' => $mandator,
        'mandator_active' => $mandator_active,
    ]) ?>
<?php
if ($mandator->taxable  == 0 )
	echo   Yii::t('app', 'The value added tax is not calculated as a small business in the sense of § 19 (1) UStG!');
?>
</div>
