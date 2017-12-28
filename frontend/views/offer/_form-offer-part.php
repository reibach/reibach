<?php
use frontend\models\Part;
use yii\helpers\Html;
?>
<td>
    <?= $form->field($part, 'part_num')->textInput([
        'id' => "Parts_{$key}_part_num",
        'name' => "Parts[$key][part_num]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'name')->textInput([
        'id' => "Parts_{$key}_name",
        'name' => "Parts[$key][name]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'quantity')->textInput([
        'id' => "Parts_{$key}_quantity",
        'name' => "Parts[$key][quantity]",
        'value' => Yii::$app->formatter->asDecimal($part['quantity']),
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'unit')->textInput([
        'id' => "Parts_{$key}_unit",
        'name' => "Parts[$key][unit]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'comment')->textInput([
        'id' => "Parts_{$key}_comment",
        'name' => "Parts[$key][comment]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'price')->textInput([
        'id' => "Parts_{$key}_price",
        'name' => "Parts[$key][price]",
        'value' => Yii::$app->formatter->asDecimal($part['price']),
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($part, 'taxrate')->textInput([
        'id' => "Parts_{$key}_taxrate",
        'name' => "Parts[$key][taxrate]",
        'value' => Yii::$app->formatter->asDecimal($part['taxrate']),
    ])->label(false) ?>
</td>
<td>
    <?= Html::a((Yii::t('app','Remove')) ." 	". $key, 'javascript:void(0);', [
      'class' => 'offer-remove-part-button btn btn-default btn-xs',
    ]) ?>
</td>
