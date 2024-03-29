<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MandatorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandator-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
   <?= $form->field($model, 'mandator_name') ?> 
    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'address_id') ?>
    <?= $form->field($model, 'taxable') ?> 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
