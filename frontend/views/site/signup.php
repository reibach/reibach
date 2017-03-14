<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?=Yii::t('app', 'Please fill out the following fields to signup:'); ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

	            <?= $form->field($model, 'password')->passwordInput() ?>
	            
				<?= $form->field($model, 'agb')->checkbox(); Html::a(Yii::t('app', 'GTC'), ['/site/gtc', ''], ['class' => 'profile-link']); ?>
	            <p class="small">
				<?= Html::a(Yii::t('app', 'General Terms & Conditions'), ['/site/gtc', ''], ['class' => 'profile-link']) ?>&nbsp;
				</p>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

