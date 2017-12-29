<!--
	<?= Yii::t('app','Please fill out this form...'); ?>	
-->
 	<?php 
	/* Steuerpflicht, eigene Rechungs und Kundennummer werden z.Zt. noch ausgeblended */
	?>
	<?= //$form->field($mandator, 'taxable')->textInput() ?> 
	<?= //Yii::t('app', 'Own Billing Numbers').' '.$form->field($mandator, 'own_bill_numbers')->checkBox(['label' => Yii::t('app', 'Own accounting numbers (not unique)'), 'value' => "1"]); ?>
	<?= //$form->field($mandator, 'own_customer_numbers')->checkBox(['label' => Yii::t('app', 'Own customer numbers (not unique)'), 'value' => "1"]); ?>
	
	<?php
	// Wenn der Mandantenname geändert wird, muss auch der Lagerort für die Rechnungen und
	// weitere Konfigurationen  geändert werden. Daher wird das Formularfeld nicht angezeigt
	// $form->field($mandator, 'mandator_name')->textInput(['maxlength' => true, 'style'=>'width:200px'])
    ?>  

<?= $form->field($mandator, 'taxable')->textInput(['maxlength' => true, 'style'=>'width:400px']) ?>

	<?= $form->field($mandator, 'own_offer_numbers')->dropDownList(['1' => 'Yes', '2' => 'No'],['prompt'=> Yii::t('app', 'Own Offer Numbers')]) ?>	
	<?= $form->field($mandator, 'own_customer_numbers')->dropDownList(['1' => 'Yes', '23' => 'No'],['prompt'=> Yii::t('app', 'Own Customer Numbers')]) ?>	


	.mandator-form { 	
		color: red;
		font-weight: bold;
		font-size: 10px;
		 } 
	.legend { 	
		color: red;
		font-weight: bold;
		font-size: 10px;
		 } 
	.fieldset { 	
		color: red;
		font-weight: bold;
		font-size: 10px;
		 } 
	.control-label { 
		color: green;
		font-weight: bold;
		font-size: 12px;
		 } 
	body { 
		color: green;
		font-weight: bold;
		font-size: 12px;
		 } 
