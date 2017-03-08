<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
?>



<link rel="stylesheet" href="rv.css" type="text/css"></head><body>
<p><img src="<?= yii\helpers\Url::to('@web/images/reibach-logo-460x460_33.png') ?>"  width="5%"/></p>

<table style="text-align: left; width: 1048px; height: 542px; background-color: rgb(238, 238, 238);" border="2" cellpadding="0" cellspacing="0">

  <caption style="font-style: italic;"><br>
  </caption><tbody>
    <tr>
      <td style="vertical-align: top;">
		<!-- Mandant -->

      <h2 style="font-style: italic;"><?= $address_mandator->company ?></h2>
      
      <div class="bill-view">
<p></p>

<?= $address_mandator->prename ?> <?= $address_mandator->lastname ?><br>
<?= $address_mandator->street ?><br>
<?= $address_mandator->housenumber ?><br>
<?= $address_mandator->zipcode." ".$address_mandator->place ?>

      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;">
      <h1 style="text-align: right;">Rechnung</h1>

      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      <br>
      <br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
<tr>
      <td style="vertical-align: top;">
		  
		  <!-- Kunde -->
		<?= $address_customer->prename ?> <?= $address_customer->lastname ?><br>
		<?= $address_customer->street ?>&nbsp;<?= $address_customer->housenumber ?><br>
		<?= $address_customer->zipcode." ".$address_customer->place ?>

      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; text-align: right;">
		  
      <!-- Rechnungsdaten--> 
		Rechnungsnummer:<span style="font-weight: bold;"><?= $model->id ?></span><br>
		Kundennummer:<span style="font-weight: bold;"><?= $model->id ?></span><br>
		Rechnungsdatum:<span style="font-weight: bold;"><?= $model->updated_at ?></span><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
    <tr>
      <td colspan="4" rowspan="1" style="vertical-align: top;">
      <h3>Positionen</h3>
      <table style="text-align: left; width: 100%; border:1px solid #BFBFBF;" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td style="vertical-align: top; border:1px solid #BFBFBF;">
            <h4>PosNum</h4>
            </td>
            <td style="vertical-align: top; width: 400px;border:1px solid #BFBFBF;">
            <h4>Name</h4>
            </td>
            <td style="vertical-align: top; width: 150px;border:1px solid #BFBFBF;">
            <h4>Einheit</h4>
            </td>
            <td style="vertical-align: top; width: 50px;border:1px solid #BFBFBF;text-align: right;">
            <h4>Anzahl</h4>
            </td>
            <td style="vertical-align: top; width: 100px;border:1px solid #BFBFBF;text-align: right;">
            <h4>EinzelPreis &#8364;</h4>
            </td>
            <td style="vertical-align: top; width: 50px; text-align: right;">
            <h4>Preis &#8364;</h4>
            </td>
          </tr>
<?= 
	ListView::widget([
		'dataProvider' => $listDataProvider,
           //'itemView' => '_item',
		'options' => [
			'tag' => 'div',
			'class' => 'list-wrapper',
			'id' => 'list-wrapper',
		],
		//'layout' => "{pager}\n{items}\n{summary}",
		   'itemView' => '_list_item',

	]);
?>
        </tbody>
      </table>
      <br>
      <br>
      </td>
    </tr>
    <tr>
      <td colspan="4" rowspan="1" style="vertical-align: top; border:1px solid #BFBFBF;">
      <table style="text-align: left; width: 100%;" border:1px solid #BFBFBF; cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td colspan="4" style="vertical-align: top;border:1px solid #BFBFBF;"><br>
            </td>
            <td style="vertical-align: top; border:1px solid #BFBFBF; width: 200px;">
            
            <h4>Gesamtpreis</h4>
            </td>
            <td style="vertical-align: top; border:1px solid #BFBFBF; width: 100px; text-align: right;">
				<h4>540,- &#8364;</h4>
            </td>
          </tr>
          
        </tbody>
      </table>
      <br>
      <br>
      <br>
      </td>
    </tr>
<tr>
<td colspan="4" rowspan="1" style="vertical-align: top; text-align: center;">Der Rechnungsbetrag ist ohne Abzug fällig innerhalb von 10 Tagen nach Erhalt der Rechnung.<br>
<br>
<br>
</td>
</tr>
<tr>
<td colspan="4" rowspan="1" style="vertical-align: top; text-align: center;">Als Kleinunternehmer im Sinne von § 19 Abs. 1 UStG wird Umsatzsteuer nicht berechnet!<br>
<br>
<br>
</td>
</tr>
<tr>
<td colspan="4" rowspan="1" style="vertical-align: top;"><br>
<br>
</td>
</tr>
    <tr>
    </tr>
  </tbody>
</table>
<br>

<table style="text-align: left; width: 1048px; height: 150px;" border="1" cellpadding="0" cellspacing="0">
        <tbody class="footer">
          <tr>
            <td style="vertical-align: top;"><br>
      </td>
	<td class="footer" style="vertical-align: top; width: 250px; border:1px solid #BFBFBF;">
            <div>federa<span class="footer"></span><span class="footer"></span><span class="footer"></span></div>
            <div>
Sibylle Schmels</div>
            <div>
An der Strasse 4</div>
            <div>
12345 Ort</div>

            </td>
            <td style="vertical-align: top; width: 50px; border:1px solid #BFBFBF;">
            <div><br>
            </div>

            </td>
            <td style="vertical-align: top; width: 250px; border:1px solid #BFBFBF;">
            <div>Tel </div>
            <div>Fax</div>
            <div>EMAIL</div>
            <div>WEB</div>

            </td>
            <td style="vertical-align: top; width: 50px; border:1px solid #BFBFBF;">
            <div><br>
            </div>

            </td>
            <td style="vertical-align: top; width: 250px; border:1px solid #BFBFBF;">
            <div>Bank</div>
            <div>IBAN: 1234 1234 1234 1234<br>
</div>
            <div>BIC:ABCDE123</div>

            </td>
            <td style="vertical-align: top; width: 50px; border:1px solid #BFBFBF;">
            <div><br>
            </div>

            </td><td style="vertical-align: top; text-align: right; width: 250px; border:1px solid #BFBFBF;">
            <div>Finanzamt<br>
Osterholz-Scharmbeck<br>
</div>
            </td>
          </tr>          
        </tbody>            
</table>
</div>
