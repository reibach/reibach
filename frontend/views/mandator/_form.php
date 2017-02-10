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


    <?= $form->field($model, 'user_id')->dropDownList(
		ArrayHelper::map(User::find()->all(),'id','username'),
		['prompt'=>'Select User']		
    ) ?>

<fieldset>
	<legend><?= Yii::t('app','Address'); ?>
	<?= $form->field($address, Yii::t('app', 'prename'))->textInput() ?>
	<?= $form->field($address, Yii::t('app', 'lastname'))->textInput() ?>
	</legend>
	
</fieldset>

    
    <div class="form-group">
    </div>
    <?= Html::submitButton('Save'); ?>
    <?php ActiveForm::end(); ?>

</div>
