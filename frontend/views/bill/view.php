<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;


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

    <h3><?= Yii::t('app', 'Mandator') ?>:&nbsp;
	<?= $address_mandator['prename'], $address_mandator['lastname'] ?>
	</h3>
<!--
  <?= DetailView::widget([
        'model' => $address_mandator,
        'attributes' => [
            'prename',
            'lastname',
            'street',
            'housenumber',
            'zipcode',
            'place',
            'phone_privat',
            'email:email',
        ],
    ]) 
?>
-->


    <h3><?= Yii::t('app', 'Customer') ?>:&nbsp;
    <?= $customer['fullName'] ?>
    </h3>


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


<!--
  <?= DetailView::widget([
        'model' => $address_customer,
        'attributes' => [
            //'id',
            'prename',
            'lastname',
            'street',
            'housenumber',
            'zipcode',
            'place',
            'phone_privat',
            'email:email',
        ],
    ]) 
?>
-->


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



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'bill_id',
            'name',
            'pos_num',
            'quantity',
            // 'unit',
            // 'comment:ntext',
            // 'price',
            // 'tax',
            // 'amount',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        
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
