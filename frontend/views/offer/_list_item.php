<p>-----------------------</p>

<?php
// YOUR_APP/views/list/_list_item.php

use yii\helpers\Html;

$pos_sum = $model['price'] * $model['quantity'];
$pos_sum = yii::$app->formatter->asDecimal($pos_sum,2);

//print_r($model);


//exit;
?>


<!--
<article class="list-item col-sm-12" data-key="<?= $model['id'] ?>">
-->

		<tr>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF; padding-left: 5px;"><?= $model['part_num'] ?></td>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF; padding-left: 5px;"><?= $model['name'] ?></td>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF; padding-left: 5px; padding-right: 5px;"><?= $model['unit'] ?></td>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF;text-align: right; padding-left: 5px;padding-right: 5px;"><?= $model['quantity'] ?></td>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF;text-align: right; padding-right: 5px;"><?= $model['price'] ?>&nbsp;&#8364;</td>
			<td style="vertical-align: top; font: 24px Arial, sans-serif; border:1px solid #BFBFBF;text-align: right; padding-right: 5px;"><?= $pos_sum ?>&nbsp;&#8364;</td>
        </tr>
 
