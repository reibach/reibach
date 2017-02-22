<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = 'Create Bill';
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
