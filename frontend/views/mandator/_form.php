<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Mandator;
use frontend\models\User;
use frontend\models\Article;
use frontend\models\Address;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */
/* @var $form yii\widgets\ActiveForm */
?>


<style> 
	a {
	position: relative;
	}
	
	
  a[data-tooltip]:before, span[data-tooltip]:before , .own_legend[data-tooltip]:before {
  position: absolute;
  left: 0;
  top: -40px;
  background-color: #ff0000;
  color: #ffffff;
  height: 30px;
  line-height: 30px;
  border-radius: 5px;
  padding: 0 15px;
  content: attr(data-tooltip);
  white-space: nowrap;
  display: none;
}

a[data-tooltip]:hover:after, a[data-tooltip]:hover:before, span[data-tooltip]:hover:after, span[data-tooltip]:hover:before {
  display: block;
}

	.own_legend { 	
		color: green;
		font-weight: bold;
		font-size: 12px;
		 } 
</style>
	 
	 
<div class="mandator-form">

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


/***
 * Huebschen
// Implement a feedback icon
echo $form->field($address, 'email', [
    'feedbackIcon' => [
        'default' => 'envelope',
        'success' => 'ok',
        'error' => 'exclamation-sign',
        'defaultOptions' => ['class'=>'text-primary']
    ]
])->textInput(['placeholder'=>'Enter a valid email address...']);



// Prepend an addon text
echo $form->field($address, 'email', ['addon' => ['prepend' => ['content'=>'@']]]);

// Append an addon text
echo $form->field($address, 'zipcode', [
    'addon' => ['append' => ['content'=>'.00']]
]);
echo "<p>Test</p>";

// Formatted addons (like icons)
echo $form->field($address, 'phone_privat', [
    'addon' => [
        'prepend' => [
            'content' => '<i class="glyphicon glyphicon-phone"></i>'
        ]
    ]
]);

// Formatted addons (inputs)
echo $form->field($address, 'phone_business', [
    'addon' => [
        'prepend' => [
            'content' => '<input type="radio">'
        ]
    ]
]);

echo "<p>Test</p>";


// Formatted addons (buttons)
echo $form->field($address, 'phone_mobile', [
    'addon' => [
        'prepend' => [
            'content' => Html::button('Go', ['class'=>'btn btn-primary']),
            'asButton' => true
        ]
    ]
]);

****/
?>

<fieldset>
	<legend>
	<?= $form->field($mandator, 'mandator_name')->textInput(['maxlength' => true, 'style'=>'width:504px']) ?>
<?= "<br/>" ?>	
	<span class="own_legend">	<?= Yii::t('app', 'Taxable').' ? '?></span>
	<?= $form->field($mandator, 'taxable')->dropDownList(['2' => Yii::t('app', 'Yes'), '1' => Yii::t('app', 'No')]) ?>	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span class="own_legend"><?= Yii::t('app', 'Own Bill Numbers').' ' ?><a href="#" data-tooltip="F&uuml;r die Eindeutigkeit muss bei eigenen Rechnungsnummern selber gesorgt werden!"> &nbsp;&nbsp;&nbsp;?*</a></span>
	<?= $form->field($mandator, 'own_bill_numbers')->dropDownList(['2' => Yii::t('app', 'Yes'),'1' => Yii::t('app', 'No')]) ?>	
<?= "<br/>" ?>	
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
	<?= $form->field($mandator, 'signature')->textarea(['rows' => 6, 'style'=>'width:504px']) ?>

	</legend>	
</fieldset>
    <div class="form-group">
		<?= Html::submitButton('Save'); ?>
		<?php ActiveForm::end(); ?>
	</div>
</div>
