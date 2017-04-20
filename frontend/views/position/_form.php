<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Bill;

/* @var $this yii\web\View */
/* @var $model frontend\models\Position */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="position-form">

    <?php $form = ActiveForm::begin(); ?>

 <?= $form->field($model, 'bill_id')->dropDownList(
		ArrayHelper::map(Bill::find()->all(),'id','id'),
		['prompt'=>'Select Bill']	
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pos_num')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'quantity', ['inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model['quantity']), 'class' => 'form-control']]) ?>
    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'price', ['inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model['price']), 'class' => 'form-control']]) ?>
    <?= $form->field($model, 'taxrate', ['inputOptions' => ['value' => Yii::$app->formatter->asDecimal($model['taxrate']), 'class' => 'form-control']]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
