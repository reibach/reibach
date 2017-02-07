<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\User;
use frontend\models\Article;
use frontend\models\Address;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandator-form">

<?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>

    <?= $model->errorSummary($form); ?>


    <?= $form->field($model->mandator, 'user_id')->dropDownList(
		ArrayHelper::map(User::find()->all(),'id','username'),
		['prompt'=>'Select User']		
    ) ?>

<fieldset>
	<legend><?= Yii::t('app','Address'); ?>
	<?php 
	$address = new Address();
	$address->loadDefaultValues();
	echo '<th>' . $address->getAttributeLabel(Yii::t('app','name')) . '</th>';
	?>


	<?= $form->field($address, 'name')->textInput() ?>
	<?= $form->field($address, 'unit')->textInput() ?>


	</legend>
	
</fieldset>

    
    <div class="form-group">
    </div>
    <?= Html::submitButton('Save'); ?>
    <?php ActiveForm::end(); ?>

</div>
