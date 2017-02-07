<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */

$this->title = Yii::t('app', 'Create Mandator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mandator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        //'modelAddress' => $modelAddress,
    ]) ?>

</div>
