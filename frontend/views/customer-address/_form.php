<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\Address;

/* @var $this yii\web\View */
/* @var $model frontend\models\CustomerAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-address-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'customer_id')->dropDownList(
		ArrayHelper::map(Customer::find()->all(),'id','id'),
		['prompt'=>'Select Customer']		
    ) ?>

    <?= $form->field($model, 'address_id')->dropDownList(
		ArrayHelper::map(Address::find()->all(),'id','id'),
		['prompt'=>'Select Address']		
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
