<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address_type')->dropDownList([ 'MANDATOR' => 'MANDATOR', 'SUPPLIER' => 'SUPPLIER', 'CUSTOMER' => 'CUSTOMER', 'DELIVERY' => 'DELIVERY', 'BILLING' => 'BILLING', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'housenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_privat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_business')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?> 
		 
	<?= $form->field($model, 'bank_account')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'bank_codenumber')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'iban')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'bic')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'tax_office')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'tax_number')->textInput(['maxlength' => true]) ?> 

	<?= $form->field($model, 'vat_number')->textInput(['maxlength' => true]) ?> 

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'update_user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
