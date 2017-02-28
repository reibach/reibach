<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Mandator;
//use backend\models\Address;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

	<!-- Mandant -->
    <?= $form->field($customer, 'mandator_id')->dropDownList(
		ArrayHelper::map(Mandator::find()->all(),'id','fullName'),
		['prompt'=>'Select Mandator']		
    ) ?>
    
   	
	<!-- Addressfelder-->
	<?= $form->field($address, 'prename')->textInput() ?>
	<?= $form->field($address, 'lastname')->textInput() ?>
	

    <div class="form-group">
        <?= Html::submitButton($customer->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
