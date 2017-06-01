<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */

$this->title = Yii::t('app', 'Update Mandator: ', [
    'modelClass' => 'Mandator',
]) . $mandator->id;
// Index wird ausgeblendet, bis MehrMandantenfähigkeit eingebaut ist
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mandator->id, 'url' => ['view', 'id' => $mandator->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mandator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'mandator' => $mandator,
        'address' => $address,
    ]) ?>

</div>
