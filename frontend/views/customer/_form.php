<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Mandator;
//use backend\models\Address;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

<?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>


<fieldset>
	<legend>
	<?= Yii::t('app','Please fill out this form...'); ?>	
	<?= $form->field($customer, 'customer_number')->textInput(['maxlength' => true]) ?>
	<?= $form->field($address, 'company')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'prename')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'lastname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'zipcode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'place')->textInput(['maxlength' => true]) ?>
	<?= $form->field($address, 'street')->textInput(['maxlength' => true]) ?>
	<?= $form->field($address, 'housenumber')->textInput(['maxlength' => true]) ?>    
	<?= $form->field($address, 'state')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'phone_privat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'phone_business')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'phone_mobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($address, 'fax')->textInput(['maxlength' => true]) ?>
	</legend>	
</fieldset>

	

    <div class="form-group">
        <?= Html::submitButton($customer->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
