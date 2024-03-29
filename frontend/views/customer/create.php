<?php
use frontend\models\Address;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */

//$this->title = Yii::$app->name.' '.Yii::t('app', 'Create Customer');
//$this->title = Yii::$app->name.' '.Yii::t('app', 'Create Customer');
$this->title = Yii::t('app', 'Create Customer');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'customer' => $customer,
        'address' => $address, 
       
    ]) ?>

</div>
