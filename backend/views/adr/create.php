<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Adr */

$this->title = Yii::t('app', 'Create Adr');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Adrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
