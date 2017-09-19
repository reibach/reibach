<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
?>

<!--
LOGO darf nur bei gueltiger Lizenz entfernt werden!
-->
<div style="
	position:absolute; 
	bottom: 10; 
	left: 44px;
	width: 100px;
	height: 30px;
	background-color: #FFFFFF;">
</div>


<table style="text-align: left; width: 1048px; height: 542px; background-color: #FFFFFF;" border="2" cellpadding="0" cellspacing="0">
	<tbody>
    <tr>
      <td style="vertical-align: top;">
		<!-- Mandant -->
				<h4 style="font: italic 36px Arial, sans-serif;"><?= $address_mandator->company ?></h4>
		<div class="bill-view" style="font: italic 24px Arial, sans-serif;">
			<?= $address_mandator->prename ?> <?= $address_mandator->lastname ?><br>
			<?= $address_mandator->street."&nbsp;".$address_mandator->housenumber ?><br>
			<?= $address_mandator->zipcode." ".$address_mandator->place ?>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;  text-align: right;"><h4 style="text-align: right;">Rechnung</h4>
      </td>
    </tr>
    <tr>
      <td colspan="5"><br>
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
		<?= Yii::t('app', 'Bill Number') ?>:&nbsp;<b><?= $model->id ?></b><br>
		<?= Yii::t('app', 'Customer Number') ?>:&nbsp;:<b><?= $model->customer_id ?></b><br>
		<?= Yii::t('app', 'Bill Date') ?>:&nbsp;:<b><?= $model->billing_date ?></b><br>
      </td>
    </tr>
    <tr>
      <td colspan="5"><br>
      </td>
    </tr>
    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top;">
 
 
      <h3><?= Yii::t('app', 'Positions') ?></h3>
      
 <table width=1048 style="text-align: left; width: 1048px; border:1px solid #BFBFBF;" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td style="vertical-align: top; width: 50px; border:1px solid #BFBFBF;">
            <h4><?=  Yii::t('app', 'Pos Num') ?></h4>
            </td>
            <td style="vertical-align: top; width: 600px;border:1px solid #BFBFBF;">
            <h4><?=  Yii::t('app', 'Name') ?></h4>
            </td>
            <td style="vertical-align: top; width: 100px;border:1px solid #BFBFBF;">
            <h4><?=  Yii::t('app', 'Unit') ?></h4>
            </td>
            <td style="vertical-align: top; width: 100px;border:1px solid #BFBFBF;text-align: right;">
            <h4><?=  Yii::t('app', 'Quantity') ?></h4>
            </td>
            <td style="vertical-align: top; width: 100px;border:1px solid #BFBFBF;text-align: right;">
            <h4><?=  Yii::t('app', 'Unit Price') ?> &#8364;</h4>
            </td>
            <td style="vertical-align: top; width: 98px; text-align: right;">
            <h4><?=  Yii::t('app', 'Total Price') ?> &#8364;</h4>
            </td>
          </tr>
			<?= 
				ListView::widget([
					'dataProvider' => $listDataProvider,
					   //'itemView' => '_item',
					//'options' => [
						//'tag' => 'div',
						//'class' => 'list-wrapper',
						//'id' => 'list-wrapper',
					//],
					//'layout' => "{pager}\n{items}\n{summary}",
					   'itemView' => '_list_item',

				]);
			?> 

			<?php
			// Gesamtpreis aller Rechungspositionen ermitteln und ausgeben
			$this->title = isset($dataProvider->models[0]->name) ? $dataProvider->models[0]->name : 'empty result';
			$myTotalPosPrice = array();

			foreach($dataProvider->models as $myModel){
						
				$taxrate = $myModel->taxrate / 100;
				$taxrate = $taxrate + 1; 		
				$myTotalPosPrice[] =  $myModel->quantity * $myModel->price * $taxrate;
						
			} 
			$billTotal = Yii::$app->formatter->asDecimal(round(array_sum($myTotalPosPrice), 2)) . "\n";
			?>
          <tr>
			<td colspan="6" style="vertical-align: top; width: 50px;border:1px solid #BFBFBF;">&nbsp;</td>
		  </tr>
          <tr>
			<td colspan="4" style="vertical-align: top; width: 50px;border:0px solid #BFBFBF;">&nbsp;</td>
            <td style="vertical-align: top; width: 50px;border:0px solid #BFBFBF;text-align: right;">
            <h2><?=  Yii::t('app', 'Invoice Amount') ?>: </h2>
            </td>
            <td style="vertical-align: top; width: 50px; text-align: right;">
            <h2><?=$billTotal ?>&nbsp;&#8364;</h2>
            </td>
          </tr>
          <tr>
			<td colspan="6" style="vertical-align: top; border:0px solid #BFBFBF;">
				<hr style="width: 100%; height: 3px; margin: 0 auto; color: #BFBFBF; background: #BFBFBF;"></td>
		  </tr>
        </tbody>
      </table>
      </td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;
      </td>
    </tr>
	<tr>
		<td colspan="6"  style="vertical-align: top; text-align: center;"><?=  Yii::t('app', 'The invoice amount is due without deduction within 10 days after receipt of the invoice.') ?><br>
		<br>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="6"  style="vertical-align: top; text-align: center;"><?=  Yii::t('app', 'The value added tax is not calculated as a small business in the sense of § 19 (1) UStG!') ?><br>
		<br>
		<br>
		</td>
	</tr>
	<tr>
		<td colspan="6"  style="vertical-align: top;"><br>
			<br>
			<hr style="align: left; width: 1048px; height: 3px; margin: 0 auto; color: #BFBFBF; background: #BFBFBF;">
			<p> <?= Html::img('@web/images/logo50.png', ['alt'=>'Reibach', 'width' => '100']) ?> </p>

			<br>
		</td>
	</tr>
  </tbody>
</table>
<br>&nbsp;

<div style="position:relativ;    bottom: 50;    width: 95%;">
<table style="text-align: left; width: 1048px; " border="0" cellpadding="0" cellspacing="0" background-color: #FFFFFF;>
        <tbody>
          <tr>
            <td style="vertical-align: top;">
			</td>
			<td style="vertical-align: top; white-space: nowrap;" width: 250px;>
				<div><b><?= $address_mandator->company ?></b></div>
				<div><?= $address_mandator->fullName ?></div>
				<div></nbr><?= $address_mandator->street ?>&nbsp;<?= $address_mandator->housenumber ?></div>
				<div><?= $address_mandator->zipcode ?>&nbsp; <?= $address_mandator->place ?></div>
			</td>
            <td style="vertical-align: top; width: 50px; border:0px solid;">
				<div></div>
            </td>
            <td style="vertical-align: top; width: 250px; border:0px solid;">
				<div><?= Yii::t('app', 'Phone').": " .$address_mandator->phone_business ?> </div>
				<div><?= Yii::t('app', 'Fax').": " .$address_mandator->fax ?></div>
				<div><?= Yii::t('app', 'Email').": " .$address_mandator->email ?></div>
				<div><?= Yii::t('app', 'Internet').": " .$address_mandator->email ?></div>
            </td>
            <td style="vertical-align: top; width: 50px; border:0px; white-space: nowrap;">
				<div></div>
            </td>
            <td style="vertical-align: top; width: 250px; border:0px solid; white-space: nowrap;">
				<div><?= Yii::t('app', 'Bank Name').": " .$address_mandator->bank_name ?></div>
				<div><?= Yii::t('app', 'Iban').": " .$address_mandator->iban ?></div>
				<div><?= Yii::t('app', 'BIC').": " .$address_mandator->bic ?></div>
				</td>
            <td style="vertical-align: top; width: 50px; border:0px solid; white-space: nowrap;">
				<div></div>
            </td><td style="vertical-align: top; width: 250px; border:0px solid;white-space: nowrap;">
				<div><?= Yii::t('app', 'Tax Office').": " .$address_mandator->tax_office ?></div>
				<div><?= Yii::t('app', 'Tax Number').": " .$address_mandator->tax_number ?></div>
<!--
				<div><?= Yii::t('app', 'Vat Number').": " .$address_mandator->vat_number ?></div>
-->
				</td>
          </tr>          
        </tbody>            
</table>
</div>
