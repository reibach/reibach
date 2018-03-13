<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mandator */

//$this->title = Yii::t('app', 'Update Mandator: ', [
    //'modelClass' => 'Mandator',
//]) . $mandator->id;

		//$this->title = Yii::t('app', 'Update {modelClass}: ', [
		   //'modelClass' => 'Mandator',
		//]) . $mandator->id;
		
//$this->title = Yii::t('app', 'Mandator').": ".$mandator->mandator_name;
//$this->params['breadcrumbs'][] = $this->title;

$this->title = Yii::t('app', 'Mandator');

	
// Index wird ausgeblendet, bis MehrMandantenfähigkeit eingebaut ist
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mandators'), 'url' => ['index']];


//Nach der Registrierung hat der MAndant keinen Namen, bekommt hier einen Defaultnamen zur Anzeige  
if (empty($mandator->mandator_name))
	$mandator->mandator_name = Yii::t('app', 'Mandator:').$mandator->id;
$this->params['breadcrumbs'][] = ['label' => $mandator->mandator_name, 'url' => ['view', 'id' => $mandator->id]];


$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mandator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'mandator' => $mandator,
        'address' => $address,
    ]) ?>

</div>
