<?php
use frontend\models\Position;
use yii\helpers\Html;
?>
<td>
    <?= $form->field($position, 'pos_num')->textInput([
        'id' => "Positions_{$key}_pos_num",
        'name' => "Positions[$key][pos_num]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($position, 'quantity')->textInput([
        'id' => "Positions_{$key}_quantity",
        'name' => "Positions[$key][quantity]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($position, 'unit')->textInput([
        'id' => "Positions_{$key}_unit",
        'name' => "Positions[$key][unit]",
    ])->label(false) ?>
</td>
<td>
    <?= Html::a('Remove ' . $key, 'javascript:void(0);', [
      'class' => 'bill-remove-position-button btn btn-default btn-xs',
    ]) ?>
</td>

