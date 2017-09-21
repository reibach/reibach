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
	<p> <?= Html::img('@web/images/logo50.png', ['alt'=>'Reibach', 'width' => '100']) ?> </p>
</div>
<table style="text-align: left; width: 1048px; height: 2096x; background-color: #FFFFFF;" border="2" cellpadding="0" cellspacing="0">
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
      <td style="vertical-align: top;  text-align: right;"><br>
      </td>
    </tr>
    <tr>
      <td colspan="5"><br><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
      </td>
    </tr>
	<tr>
      <td style="vertical-align: top; font: 24px Arial, sans-serif;">
		<!-- Kunde -->
		<?= $address_customer->prename ?> <?= $address_customer->lastname ?><br>
		<?= $address_customer->street ?>&nbsp;<?= $address_customer->housenumber ?><br>
		<?= $address_customer->zipcode." ".$address_customer->place ?>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; font: 24px Arial, sans-serif; text-align: right;">		  
      <!-- Rechnungsdaten--> 
		<?= Yii::t('app', 'Bill Number') ?>:&nbsp;<b><?= $model->id ?></b><br>
		<?= Yii::t('app', 'Customer Number') ?>:&nbsp;:<b><?= $model->customer_id ?></b><br>
		<?= Yii::t('app', 'Bill Date') ?>:&nbsp;:<b><?= $model->billing_date ?></b><br>
      </td>
    </tr>
    <tr>
      <td colspan="5"><br><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
      </td>
    </tr>
    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top; font: 24px Arial, sans-serif; border:0px solid #BFBFBF; padding-left: 5px;">
		<?= $model->description ?>
	</td>
	</tr>
    <tr>
      <td colspan="5" rowspan="1" style="vertical-align: top; font: 24px Arial, sans-serif; border:0px solid #BFBFBF; padding-left: 5px;">
 
 
      <?= Yii::t('app', 'Positions') ?><p>&nbsp;</p>
      
      <table width=1048 style="text-align: left; width: 1048px; border:0px solid #BFBFBF;" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 100px; border:1px solid #BFBFBF; padding-left: 5px;">
            <?=  Yii::t('app', 'Pos Num') ?>
            </td>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 500px;border:1px solid #BFBFBF; padding-left: 5px;">
            <?=  Yii::t('app', 'Name') ?>
            </td>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 75px;border:1px solid #BFBFBF; padding-left: 5px; padding-right: 5px;">
            <?=  Yii::t('app', 'Unit') ?>
            </td>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 75px;border:1px solid #BFBFBF;text-align: right; padding-left: 5px; padding-right: 5px;">
            <?=  Yii::t('app', 'Quantity') ?>
            </td>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 100px;border:1px solid #BFBFBF;text-align: right;padding-right: 5px;">
            <?=  Yii::t('app', 'Unit Price') ?> &#8364;
            </td>
            <td style="vertical-align: top; font: 24px Arial, sans-serif; width: 150px; border:1px solid #BFBFBF; text-align: right; white-space: nowrap; padding-right: 5px; padding-left: 5px;">
            <?=  Yii::t('app', 'Total Price') ?> &#8364;
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
			<td colspan="6" style="vertical-align: top; width: 50px;border:0px solid #BFBFBF;"><p>&nbsp;</p><p>&nbsp;</p></td>
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
      <td colspan="6">&nbsp;<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
      </td>
    </tr>
	<tr>
		<td colspan="6"  style="vertical-align: top; font: 24px Arial, sans-serif; text-align: center;"><?=  Yii::t('app', 'The invoice amount is due without deduction within 10 days after receipt of the invoice.') ?><br>
		<br>
		<br>
		</td>
	</tr>
    <tr>
      <td colspan="6">&nbsp;<p>&nbsp;</p><p>&nbsp;</p>
      </td>
    </tr>
	<tr>
		<td colspan="6"  style="vertical-align: top; font: 24px Arial, sans-serif; text-align: center;"><?=  Yii::t('app', 'The value added tax is not calculated as a small business in the sense of § 19 (1) UStG!') ?><br>
		<br>
		<br>
		</td>
	</tr>
  </tbody>
</table>
<br>&nbsp;

<div style="position:absolute; bottom: 50;">
<table style="text-align: left; width: 678px;">
        <tbody>
          <tr>
			<td style="vertical-align: top; white-space: nowrap; width: 150px; font: 10px Arial, sans-serif; white-space: nowrap;">
				<div><b><?= $address_mandator->company ?></b></div>
				<div><?= $address_mandator->fullName ?></div>
				<div></nbr><?= $address_mandator->street ?>&nbsp;<?= $address_mandator->housenumber ?></div>
				<div><?= $address_mandator->zipcode ?>&nbsp; <?= $address_mandator->place ?></div>
			</td>
			<td style="vertical-align: top; width: 10px;">&nbsp;
			</td>
		            <td style="vertical-align: top; width: 150px; font: 10px Arial, sans-serif; white-space: nowrap;">
				<div><?=  Yii::t('app', 'Phone').": " .$address_mandator->phone_business ?> </div>
				<div><?= Yii::t('app', 'Fax').": " .$address_mandator->fax ?></div>
				<div><?= Yii::t('app', 'Email').": " .$address_mandator->email ?></div>
				<div><?= Yii::t('app', 'Internet').": " .$address_mandator->email ?></div>
            </td>
          <td style="vertical-align: top; width: 10px; white-space: nowrap;">
				&nbsp;
            </td>
            <td style="vertical-align: top; width: 150px; font: 10px Arial, sans-serif; white-space: nowrap;">
				<div><?= Yii::t('app', 'Bank Name').": " .$address_mandator->bank_name ?></div>
				<div><?= Yii::t('app', 'Iban').": " .$address_mandator->iban ?></div>
				<div><?= Yii::t('app', 'BIC').": " .$address_mandator->bic ?></div>
				</td>
            <td style="vertical-align: top; width: 10px; white-space: nowrap;">
				&nbsp;
            </td><td style="vertical-align: top; width: 118px; border:0px solid; font: 10px Arial, sans-serif; white-space: nowrap;">
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
