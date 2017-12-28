<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Abosystems');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>h2 { 
	color: white;
	font-weight: bold;
	 } </style>
	
<div class="site-abosystem">
    <h1><?= Html::encode($this->title) ?></h1>
    
    
<H3>Es gibt drei verschiedene Abosysteme zur Abrechnung</H3>
 
  <h2 style="background: linear-gradient( #008000, #44D744 30%);width: 20%;">FREE</h2>
  <h4>kostet nichts,</h4>
  <li>Logo bleibt erhalten</li>
  <li>Registrierung gen&uuml;gt</li>
  <p>&nbsp;</p>


  <h2 style="background: linear-gradient( #A52A2A, #CD6C6C 30%);width: 20%;">STANDARD</h2>
  <h4>  kostet 4,90 € / mntl.</h4> 
  <p>&nbsp;</p>

  <h2  style="background: linear-gradient( #003471, #448CCB 30%);width: 20%;">PREMIUM</h2>
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
