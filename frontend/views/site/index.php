<?php

/* @var $this yii\web\View */

$this->title = 'Reibach ... to make a big haul.';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yo, </h1>

        <p class="lead"><?php echo Yii::t('app','This is Reibach'); ?></p>
      


        <p><img src="<?= yii\helpers\Url::to('@web/images/reibach-logo-200x200.png') ?>" />
          <br>... to make a big haul</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Was ist Reibach?</h2>
					<p>
					Reibach ist ein einfaches Rechnungsprogramm welches nur eine Registrierung benötigt, um 
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
                Das Lizensmodell wird noch ausgearbeitet, Spenden sind jetzt schon erwünscht. (Beratungs-)Dienstleistungen
                werden erbracht und in Rechnung gestellt.  
				</p>
<!--
                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
-->
            </div>
        </div>

    </div>
</div>
