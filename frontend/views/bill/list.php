<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>



<?= 
ListView::widget([
    'dataProvider' => $listDataProvider,
    'itemView' => '_item',
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'layout' => "{pager}\n{items}\n{summary}",
]);
?>



