<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Mandator;
use frontend\models\User;
use frontend\models\Article;
use frontend\models\Address;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandator-form">


<?php //$form = ActiveForm::begin(['enableClientValidation' => false, // TODO get this working with client validation]); ?>
<?php $form = ActiveForm::begin(); ?>

<fieldset>
	<legend>
	<?= Yii::t('app','Please fill out this form...'); ?>	
	<?php 
	/* Steuerpflicht, eigene Rechungs und Kundennummer werden z.Zt. noch ausgeblended
	<?= // $form->field($mandator, 'taxable')->textInput() ?> 
	<?= // $form->field($mandator, 'b_id')->checkBox(['label' => Yii::t('app', 'Own accounting numbers (not unique)'), 'value' => "1"]); ?>
	<?= // $form->field($mandator, 'c_id')->checkBox(['label' => Yii::t('app', 'Own customer numbers (not unique)'), 'value' => "1"]); ?>
	*/
	?>
	<?= $form->field($mandator, 'signature')->textarea(['rows' => 6]) ?>
    <?= $form->field($mandator, 'mandator_name')->textInput(['maxlength' => true]) ?>

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
	<?= $form->field($address, 'bank_name')->textInput(['maxlength' => true]) ?> 		 
	<?= $form->field($address, 'bank_account')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'bank_codenumber')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'iban')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'bic')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'tax_office')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'tax_number')->textInput(['maxlength' => true]) ?> 
	<?= $form->field($address, 'vat_number')->textInput(['maxlength' => true]) ?> 
	</legend>	
</fieldset>




    
    <div class="form-group">
    </div>
    <?= Html::submitButton('Save'); ?>
    <?php ActiveForm::end(); ?>

</div>
