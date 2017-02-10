

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
?>
<div class="bill-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'description:ntext',
            'price',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) 
?>

  <p><img src="<?= yii\helpers\Url::to('@web/images/reibach-logo-460x460_33.png') ?>"  width="20%"/></p>

</div>
