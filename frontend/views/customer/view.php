<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

//$this->title = Yii::$app->name.' '.Yii::t('app', 'Customer').": ".$model->id;
$this->title = Yii::t('app', 'Customer').": ".$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

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
<!--
	<p>AddressMandator: <?= $address_mandator->fullName; ?></p>
-->


<!--
	<p>TestStr: <?= $model->getTestString(); ?></p>
-->




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			//'id',
            //'customer_number',            
            'mandator_id',
            'fullName',
            'payment_term',
        ],
    ]) ?>

<!--
    <?= DetailView::widget([
        'model' => $address,
        'attributes' => [
            //'id',
            'street',
            'housenumber',
            'zipcode',
            'place',
           
        ],
    ]) ?>
-->


</div>
