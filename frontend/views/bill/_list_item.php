

<?php
// YOUR_APP/views/list/_list_item.php

use yii\helpers\Html;


$pos_sum = $model['price'] * $model['quantity'];
?>
<article class="list-item col-sm-12" data-key="<?= $model['id'] ?>">
		<tr>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $model['pos_num'] ?></td>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $model['name'] ?></td>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $model['unit'] ?></td>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $model['quantity'] ?></td>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $model['price'] ?></td>
			<td style="vertical-align: top;border:1px solid #BFBFBF;"><?= $pos_sum ?></td>
        </tr>
 
