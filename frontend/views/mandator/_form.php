<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\User;
use frontend\models\Address;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mandator-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'user_id')->dropDownList(
		ArrayHelper::map(User::find()->all(),'id','username'),
		['prompt'=>'Select User']		
    ) ?>
	<?= $form->field($model, 'address_id')->textInput() ?>


	<?= $form->field($modelAddress, 'prename')->textInput() ?>
	<?= $form->field($modelAddress, 'lastname')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
