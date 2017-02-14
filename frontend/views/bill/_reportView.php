

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
?>
<div class="bill-view">

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

    <?= ListView::widget([
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
		//'options'=>['class'=>'grid-view gridview-newclass'],
    ]); ?>

  <p><img src="<?= yii\helpers\Url::to('@web/images/reibach-logo-460x460_33.png') ?>"  width="20%"/></p>

</div>
