<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Abosystems');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-abosystem">
    <h1><?= Html::encode($this->title) ?></h1>
    
    
<H3>Es gibt drei verschiedene Abosysteme zur Abrechnung</H3>
 
  <h2>free</h2>
  <h4>kostet nichts, Logo bleibt erhalten</h4>
  
  <h2>standard</h2>
  <h4>  kostet 4,90 € / mntl.</h4> 

  <h2>premium</h2>
  <h4>kostet 9,90 € / mntl.</h4> 
      <li>eigene Datenbank</li>
      <li>Mehrmandantenfähig</li>
      <li>Zugriff auf alle Module</li>

<p>&nbsp;</p>
<p>Alle Abos sind monatlich kündbar, als Frist gelten 4 Wochen zum Monatsende.</p>
<p>Als Zahlweise werden SEPA-Lastschrift und Vorabüberweisung angeboten. 
<br>Zahlungen per paypal oder paydirekt nur auf Wunsch und gegen Aufwandsentschädigung (ca. 0,50 € / mntl.).  </p>

<!--
    <code><?= __FILE__ ?></code>
-->
</div>
