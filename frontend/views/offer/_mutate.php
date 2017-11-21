<?php
//namespace yii\jui;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\Part;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">
	
<?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>

    <?= $model->errorSummary($form); ?>

	<?php 			
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		echo "customer_id: ".$model->offer->customer_id;
		echo "<p></p>";
		echo "mandator_id: ".$mandator_active;
		echo "<p></p>";
		echo "offer_date: ".$model->offer->offer_date;
		echo "<p></p>";
		echo "offer_description: ".$model->offer->description;
		
		
		echo "<p></p>";
		print_r($model->parts);
		echo "<p></p>";

	?> 		
		
