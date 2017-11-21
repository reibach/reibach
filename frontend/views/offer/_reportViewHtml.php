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


          
<?php 

$data = $model->attributes;
print_r($data);


//print_r($model);
?>
<p></p>


<?php
//print_r($listDataProvider);
//exit;
?>
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

//print_r($listDataProvider);
?>
