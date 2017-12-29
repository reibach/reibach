<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mandator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mandator_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'taxable')->textInput() ?>

    <?= $form->field($model, 'own_bill_numbers')->textInput() ?>

    <?= $form->field($model, 'own_offer_numbers')->textInput() ?>

    <?= $form->field($model, 'own_customer_numbers')->textInput() ?>

    <?= $form->field($model, 'signature')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
