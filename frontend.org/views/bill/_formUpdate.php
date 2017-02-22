<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(); ?>

    <fieldset>
        <legend><?= Yii::t('app','Customer'); ?></legend>

    <?= $form->field($model, 'customer_id')->dropDownList(
		ArrayHelper::map(Customer::find()->all(),'id','id'),
		['prompt'=>Yii::t('app','Select Customer')]	
    ) ?>
    </fieldset>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
