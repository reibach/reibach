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
        'value' => Yii::$app->formatter->asDecimal($position['quantity']),
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
        'value' => Yii::$app->formatter->asDecimal($position['price']),
    ])->label(false) ?>
</td>
<td>
<?php 
if ($mandator->taxable  != 0 )  {
	echo $form->field($position, 'taxrate')->textInput([
        'id' => "Positions_{$key}_taxrate",
        'name' => "Positions[$key][taxrate]",
        'value' => Yii::$app->formatter->asDecimal($position['taxrate']),
    ])->label(false);
} else {
	echo $form->field($position, 'taxrate')->hiddenInput([
		'value'=> '0',
		'id' => "Positions_{$key}_taxrate",
        'name' => "Positions[$key][taxrate]"
		])->label(true);
}
?>
</td>

<td>
    <?= Html::a((Yii::t('app','Remove')) ." 	". $key, 'javascript:void(0);', [
      'class' => 'bill-remove-position-button btn btn-default btn-xs',
    ]) ?>
</td>
