<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */

$this->title = $model->id;
// Index wird ausgeblendet, bis MehrMandantenfähigkeit eingebaut ist
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$session = Yii::$app->session;
$mandator_active = $session->set('mandator_active', $model->id);

?>
<div class="mandator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'user_id',
            'address_id',
            'fullName',
            'taxable',
        ],
    ]) ?>

</div>
