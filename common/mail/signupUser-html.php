<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hallo, </p>
    
    <p>und willkommen neuer Benutzer <b><?= Html::encode($user->username) ?></b> bei Reibach, dem online Rechnungsprogramm.</p>
    <p>Schön, dass du da bist. Als nächsten Schritt solltest du deinen Mandanten bearbeiten, falls noch nicht geschehen.</p>
	<p>Solltest du irgendwelche Fragen oder Anregungen haben, zögere nicht, dich mit uns in Verbindung zu setzen.</p>
	<p></p>
	<p></p>
	<p>Reibach - to make a big haul
	<br>Inh. Guenter Mittler</p>
	
	Buxhorner Weg 15
	<br>27729 Holste
	<br>Steuernummer 36/130/11311 

	<p><a href="mailto:info@reibach-rechnung.de">info@reibach-rechnung.de</a>
	<br><a href="https://reibach-rechnung.de">https://reibach-rechnung.de</a></p>	
</div>
