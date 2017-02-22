<?php
use frontend\models\Parcel;
use yii\helpers\Html;
?>
<td>
    <?= $form->field($parcel, 'code')->textInput([
        'id' => "Parcels_{$key}_code",
        'name' => "Parcels[$key][code]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($parcel, 'height')->textInput([
        'id' => "Parcels_{$key}_height",
        'name' => "Parcels[$key][height]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($parcel, 'width')->textInput([
        'id' => "Parcels_{$key}_width",
        'name' => "Parcels[$key][width]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($parcel, 'depth')->textInput([
        'id' => "Parcels_{$key}_depth",
        'name' => "Parcels[$key][depth]",
    ])->label(false) ?>
</td>
<td>
    <?= Html::a('Remove ' . $key, 'javascript:void(0);', [
      'class' => 'product-remove-parcel-button btn btn-default btn-xs',
    ]) ?>
</td>
