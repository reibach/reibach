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
    <?= $form->field($position, 'name')->textInput([
        'id' => "Positions_{$key}_name",
        'name' => "Positions[$key][name]",
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
    <?= $form->field($position, 'comment')->textInput([
        'id' => "Positions_{$key}_comment",
        'name' => "Positions[$key][comment]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($position, 'price')->textInput([
        'id' => "Positions_{$key}_price",
        'name' => "Positions[$key][price]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($position, 'tax')->textInput([
        'id' => "Positions_{$key}_tax",
        'name' => "Positions[$key][tax]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($position, 'amount')->textInput([
        'id' => "Positions_{$key}_amount",
        'name' => "Positions[$key][amount]",
    ])->label(false) ?>
</td>
<td>
    <?= Html::a((Yii::t('app','Remove')) ." 	". $key, 'javascript:void(0);', [
      'class' => 'bill-remove-position-button btn btn-default btn-xs',
    ]) ?>
</td>
