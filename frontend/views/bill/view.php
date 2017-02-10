<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-view">

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

    <h1><?= Yii::t('app', 'Mandator') ?></h1>
  <?= DetailView::widget([
        'model' => $address_mandator,
        'attributes' => [
            'prename',
            'lastname',
            'address1',
            'zipcode',
            'place',
            'phone_privat',
            'email:email',
        ],
    ]) 
?>


    <h1><?= Yii::t('app', 'Customer') ?></h1>
<!--
    <?= DetailView::widget([
        'model' => $customer,
        'attributes' => [
            'id',
            'mandator_id',
            'fullName',
        ],
    ]) 
?>
-->
  <?= DetailView::widget([
        'model' => $address_customer,
        'attributes' => [
            //'id',
            'prename',
            'lastname',
            'address1',
            'zipcode',
            'place',
            'phone_privat',
            'email:email',
        ],
    ]) 
?>


    <h1><?= Yii::t('app', 'Bill') ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'description:ntext',
            'price',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) 
?>
    <h1><?= Yii::t('app', 'Positions') ?></h1>
    <?= DetailView::widget([
        'model' => $positions,
        'attributes' => [
            'id',
            'bill_id',
            'name',
            'pos_num',
            'quantity',
        ],
    ]) 
?>
<?php 
	/**
	 * THE VIEW BUTTON
	 */
	 $desc = Yii::t('app', 'Print PDF');
	 echo Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> '.$desc, ['/bill/report', 'id' => $model->id], [
		'class'=>'btn btn-danger', 
		'target'=>'_blank', 
		'data-toggle'=>'tooltip', 
		'title'=>'Will open the generated PDF file in a new window'
	]);
?>
</div>
