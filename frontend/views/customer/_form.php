<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Mandator;
//use frontend\models\Address;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($customer, 'mandator_id')->dropDownList(
		ArrayHelper::map(Mandator::find()->all(),'id','id'),
		['prompt'=>'Select Mandator']
		
    ) ?>

	<!-- Addressfelder-->
	<?= $form->field($address, Yii::t('app', 'prename'))->textInput() ?>
	<?= $form->field($address, Yii::t('app', 'lastname'))->textInput() ?>
	

    <div class="form-group">
        <?= Html::submitButton($customer->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
