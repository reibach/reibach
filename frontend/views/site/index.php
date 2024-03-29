<?php
use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Reibach ... to make a big haul.';


?>
<div class="site-index">

    <div class="jumbotron">
<!--
        <h1>Yo, </h1>

		
        <p class="lead"><?php echo Yii::t('app','This is Reibach'); ?></p>
      
-->

<h3>Willkommen,</h3>
<h4>zu Reibach, dem Online-Rechnungsprogramm</h4>

<p>Lege <?= Html::a(Yii::t('app', 'Hier'), ['/site/signup', ''], ['class' => 'profile-link']) ?> gleich los oder starte das
        <a class="btn btn-default" href="https://reibach-rechnung.de/demo/" target="_new">Demo</a></p>

<p>Benutzername: demo <br>
Passwort: demodemo
</p>

<?= Html::a(Yii::t('app', 'Quickstart'), ['/site/quickstart', ''], ['class' => 'profile-link']) ?>
<!--
http://172.22.119.118/reibach/frontend/web/quickstart?1=
http://172.22.119.118/reibach/frontend/web/index.php/site/quickstart?1=
-->



<!--
        <p><a href="<?=yii\helpers\Url::to('site/quickstart') ?>"><img src="<?= yii\helpers\Url::to('@web/images/quickstartguide.png') ?>" width="400"/></a></p>
-->
        <p><img src="<?= yii\helpers\Url::to('@web/images/quickstartguide.png') ?>" width="400"/></p>
  
        <p>Alle weiteren Informationen finden sich im <a class="btn btn-default" href="https://doku.federa.de/" target="_new">Wiki</a></p>
        

<p></p>
		&nbsp;


    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Was ist Reibach?</h2>
					<p>
					Reibach ist ein einfaches Rechnungsprogramm, welches nur eine Registrierung benötigt, um 
					lauffähig zu sein. Nach Eingabe der Grunddaten kann die erste Rechnung binnen Sekunden 
					erstellt werden.  
					</p>



<!--
                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
-->


            </div>
            <div class="col-lg-4">
                <h2>Für wen ist Reibach?</h2>

                <p>Reibach richtet sich an alle Personen, Firmen, Freischaffende oder Institutionen die Rechnungen stellen. 
                
                </p>

<!--
                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
-->
            </div>
            <div class="col-lg-4">
                <h2>Warum kostet das nichts?</h2>

                <p>Reibach ist nicht umsonst, wer es nutzt, muss Werbung machen (Wasserzeichen) oder sich freikaufen. 
                Das Lizensmodell findet sich unter <?= Html::a(Yii::t('app', 'Abosystems'), ['/site/abosystem', ''], ['class' => 'abosystem-link']) ?>, Spenden sind jetzt schon erwünscht. (Beratungs-)Dienstleistungen
                werden erbracht und  - natürlich mit Reibach - in Rechnung gestellt.  
				</p>

<!--
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
-->
            </div>
        </div>

    </div>
</div>
