<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?= Yii::t('app', 'Hello').' <b>'. Html::encode($user->username) ?>,</b></p>

    <p><?= Yii::t('app', 'Follow the link below to reset your password:') ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    
    <p>Reibach - to make a big haul
	<br>Inh. Guenter Mittler</p>
	
	Buxhorner Weg 15
	<br>27729 Holste
	<br>Steuernummer 36/130/11311 

	<p><a href="mailto:info@reibach-rechnung.de">info@reibach-rechnung.de</a>
	<br><a href="https://reibach-rechnung.de">https://reibach-rechnung.de</a></p>	
</div>
