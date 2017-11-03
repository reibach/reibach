<?php
//namespace yii\jui;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\Position;
use yii\jui\DatePicker;
use yii\captcha\Captcha;


/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">
	

 <?php $form = ActiveForm::begin(['id' => 'mailfile-form']); ?>

    <?= $model->errorSummary($form); ?>

    <fieldset>
        <legend><?= Yii::t('app','Send Bill'); ?></legend>
			<h4><?= Yii::t('app', 'Customer') ?>:&nbsp; <?= $customer['fullName'] ?></h4>
			<h4><?= Yii::t('app', 'CustomerEMail') ?>:&nbsp; <?= $customer['email'] ?></h4>
			<h4><?= Yii::t('app', 'Billing Date') ?>:&nbsp; <?= $model->bill['updated_at'] ?></h4>
    </fieldset>

    <div class="row">
        <div class="col-lg-5">
<?php 

echo  "Rechnungsdatei: ".$filename;
?>

				<?= $form->field($customer, 'email')->textInput(['maxlength' => true]) ?>
    
				<?php
				if (empty($model[ 'subject']))
					$model['subject'] = Yii::t('app','Bill').": R_".$model->bill->id
				?>
                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>            
