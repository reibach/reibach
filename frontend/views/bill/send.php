<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//$this->title = $bill->id;
//$this->title = Yii::t('app', 'Send');
$this->title = Yii::t('app', 'Send {modelClass}: ', [
    'modelClass' => 'Bill',
]) . $bill->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
// $billfile =  '/var/www/html/reibach/frontend/web/bills/MAN'.$bill['mandator_id'].'/R_'.$bill->id.'.pdf'; 
// echo $billfile;
?>

<div class="bill-send">
    <h1><?= Html::encode($this->title) ?></h1>
<!--

    <fieldset>
        <legend><?= Yii::t('app','Send Bill'); ?></legend>
			<h4><?= Yii::t('app', 'Customer') ?>:&nbsp; <?= $customer['fullName'] ?></h4>
			<h4><?= Yii::t('app', 'CustomerEMail') ?>:&nbsp; <?= $customer_address['email'] ?></h4>
			<h4><?= Yii::t('app', 'Billing Date') ?>:&nbsp; <?= $bill['updated_at'] ?></h4>
    </fieldset>
-->


    <p>
       <?= Yii::t('app', 'Sending the bill to the customer.') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'send-form']); ?>

				<?php if (empty($model[ 'name']))
					$model['name'] = $customer['fullName']; ?>                
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>


				<?php if (empty($model[ 'email']))
					$model['email'] = $customer_address['email']; ?>
                <?= $form->field($model, 'email') ?>


				<?php if (empty($model[ 'subject']))
					$model['subject'] = Yii::t('app','Bill').": R_".$bill->id; ?>				
                <?= $form->field($model, 'subject') ?>

				<?php if (empty($model[ 'body']))
					$model['body'] = "\n\n--\n".$mandator->signature; ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
