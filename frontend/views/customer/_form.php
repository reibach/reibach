<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Mandator;

//use frontend\models\User;
//use frontend\models\Article;
//use frontend\models\Address;


//use backend\models\Address;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

<?php //$form = ActiveForm::begin(['enableClientValidation' => false, // TODO get this working with client validation]); ?>
<?php 

//$form = ActiveForm::begin(); 
// Horizontal Form Configuration
$form = ActiveForm::begin([
    'id' => 'form-signup', 
    'type' => ActiveForm::TYPE_INLINE,
    //'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 0, 'deviceSize' => ActiveForm::SIZE_SMALL, 'showLabels' => false]
]);
?>

<fieldset>
	<legend>
<!--
	<?= Yii::t('app','Please fill out this form...'); ?>	
-->
	<?php 
	/* Steuerpflicht, eigene Rechungs und Kundennummer werden z.Zt. noch ausgeblended
	<?= // $form->field($mandator, 'taxable')->textInput() ?> 
	<?= // $form->field($mandator, 'b_id')->checkBox(['label' => Yii::t('app', 'Own accounting numbers (not unique)'), 'value' => "1"]); ?>
	<?= // $form->field($mandator, 'c_id')->checkBox(['label' => Yii::t('app', 'Own customer numbers (not unique)'), 'value' => "1"]); ?>
	*/
	?>
	
	<?php
	// Wenn der Mandantenname geändert wird, muss auch der Lagerort für die Rechnungen und
	// weitere Konfigurationen  geändert werden. Daher wird das Formularfeld nicht angezeigt
	// $form->field($mandator, 'mandator_name')->textInput(['maxlength' => true, 'style'=>'width:200px'])
    ?>
    

	<?= $form->field($address, 'company')->textInput(['maxlength' => true, 'style'=>'width:400px']) ?>
	<?= $form->field($address, 'title')->textInput(['maxlength' => true, 'style'=>'width:100px']) ?> 

<?= "<br/>" ?>	
    <?= $form->field($address, 'prename')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
    <?= $form->field($address, 'lastname')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
<?= "<br/>" ?>	

	<?= $form->field($address, 'street')->textInput(['maxlength' => true, 'style'=>'width:400px']) ?>
	<?= $form->field($address, 'housenumber')->textInput(['maxlength' => true, 'style'=>'width:100px']) ?>    
<?= "<br/>" ?>	
    <?= $form->field($address, 'zipcode')->textInput(['maxlength' => true, 'style'=>'width:100px']) ?>
    <?= $form->field($address, 'place')->textInput(['maxlength' => true, 'style'=>'width:400px']) ?>
<?= "<p>&nbsp;</p>" ?>	
    <?= $form->field($address, 'phone_privat')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
    <?= $form->field($address, 'phone_business')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
<?= "<br/>" ?>	
    <?= $form->field($address, 'phone_mobile')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
    <?= $form->field($address, 'fax')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
<?= "<br/>" ?>	
	

<?php
// Prepend an addon text
//echo $form->field($address, 'email', ['style'=>'width:600px', 'addon' => ['prepend' => ['content'=>'@']]]);
?>
    <?= $form->field($address, 'email')->textInput(['maxlength' => true, 'style'=>'width:250px', 'addon' => ['prepend' => ['content'=>'@']]]) ?>
    <?= $form->field($address, 'internet')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?>
<?= "<p>&nbsp;</p>" ?>	

<!--
	<?= $form->field($address, 'bank_account')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?> 
	<?= $form->field($address, 'bank_codenumber')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?> 
-->
	<?= $form->field($address, 'bank_name')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?> 		 
	<?= $form->field($address, 'iban')->textInput(['maxlength' => true, 'style'=>'width:250px']) ?> 
<?= "<br/>" ?>	

	<?= $form->field($address, 'bic')->textInput(['maxlength' => true, 'style'=>'width:94px']) ?> 
	<?= $form->field($address, 'tax_office')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?> 
	<?= $form->field($address, 'tax_number')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?> 
<?= "<br/>" ?>	

<!--
	<?= $form->field($address, 'vat_number')->textInput(['maxlength' => true, 'style'=>'width:200px']) ?> 
	<?= $form->field($address, 'state')->textInput(['maxlength' => true, 'style'=>'width:400px']) ?>
-->

	</legend>	
</fieldset>
    <div class="form-group">
		<?= Html::submitButton('Save'); ?>
		<?php ActiveForm::end(); ?>
	</div>
</div>
