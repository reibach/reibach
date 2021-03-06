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

<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'customer' => $customer,
        'address' => $address, 
       
    ]) ?>

</div>


<div class="customer-createForm">
	

    <?php $form = ActiveForm::begin(); ?>    	

	<?= $form->field($customer, 'customer_number')->textInput() ?>
	
	<!-- Addressfelder-->
		<?= $form->field($address, 'prename')->textInput() ?>
	<?= $form->field($address, 'lastname')->textInput() ?>
	

    <div class="form-group">
        <?= Html::submitButton($customer->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $customer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
