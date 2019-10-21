<?php
//namespace yii\jui;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\Position;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">
	
<?php $form = ActiveForm::begin([
        'enableClientValidation' => false, // TODO get this working with client validation
    ]); ?>

    <?= $model->errorSummary($form); ?>

    <fieldset>
        <legend><?= Yii::t('app','Customers'); ?></legend>
	<?php 
			
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
	?> 

    <?= $form->field($model->bill, 'customer_id')->dropDownList(
		ArrayHelper::map(Customer::find()
		->where(['mandator_id' => $mandator_active])
		->orderBy(['id'=>SORT_DESC])
		->all(),'id','fullName'),
		['prompt'=>Yii::t('app','Select Customer')])
		->label(false) ?>
    </fieldset>
   
	<?php
        //echo $form->field($model->bill, 'updated_at')->widget(DatePicker::className(), [
            //'language' => 'de',
            //'inline' => false,
            //'dateFormat' => 'dd.MM.yyyy',
            //'clientOptions' => [
                //'showAnim'=>'slideDown',
                //'yearRange' => '2017:2022',
                //'changeMonth'=> true,
                //'changeYear'=> true,
                //'autoSize'=>true,
                //'showOn'=> "button",
                //'buttonText' => 'Kalender',
            //]
        //]);

    ?>

<p><?= Yii::t('app', 'Billing Date') ?></p>

<?php 
	echo DatePicker::widget([
    'model' => $model->bill,
    'attribute' => 'billing_date',
    'language' => 'de',
    //'dateFormat' => 'dd.MM.yyyy',
    'dateFormat' => 'yyyy-MM-dd',
    //'saveFormat' => 'php:Y-m-d'
]);

?>
	
	
	<fieldset>
	<legend>
	
	<?= $form->field($model->bill, 'description')->textArea(['rows' => '4']) ?>
	</legend>
	</legend>
		
	<fieldset>
	<legend><?= Yii::t('app','Positions'); ?>
		<?php
		// new position button
		echo Html::a(Yii::t('app','New Position'), 'javascript:void(0);', [
		  'id' => 'bill-new-position-button', 
		  'class' => 'pull-right btn btn-default btn-xs'
		])
		?>
	</legend>
	
		<?php     
	    // position table
        $position = new Position();
        $position->loadDefaultValues();
        echo '<table id="bill-positions" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','pos_num')) . '</th>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','name')) . '</th>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','quantity')) . '</th>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','unit')) . '</th>';
        // echo '<th>' . $position->getAttributeLabel(Yii::t('app','comment')) . '</th>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','price')) . '</th>';
        echo '<th>' . $position->getAttributeLabel(Yii::t('app','taxrate')) . '</th>';
        //echo '<td>&nbsp;</td>';
        echo '</tr>';
        echo '</thead>';
        
        //print_r($model->positions);
        //print_r($_positions);
        
        // existing positions fields
        foreach ($model->positions as $key => $_position) {
          echo '<tr>';
          echo $this->render('_form-bill-position', [
            'key' => $_position->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_position->id,
            'form' => $form,
            'mandator' => $mandator,
            'position' => $_position,
          ]);
          echo '</tr>';
        }
        
        
        // new position fields
        echo '<tr id="bill-new-position-block" style="display: none;">';
        echo $this->render('_form-bill-position-new', [
            'key' => '__id__',
            'form' => $form,
            'mandator' => $mandator,
            'position' => $position,
            
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        
         // register JS assets required for widgets
		//\zhuravljov\widgets\DatePickerAsset::register($this);
        ?>
        <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            // add position button
            var position_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
           
            $('#bill-new-position-button').on('click', function () {
				position_k += 1;
                $('#bill-positions').find('tbody')
                  .append('<tr>' + $('#bill-new-position-block').html().replace(/__id__/g, 'new' + position_k) + '</tr>');
                
                // datepicker on copied row
                $('#Positions_new' + position_k + '_date_ordered').datepicker({
                    "autoclose": true,
                    "todayHighlight": true,
                    "format": "yyyy-mm-dd",
                    "orientation": "top left"
                });
                
            });
            
            // remove position button
            $(document).on('click', '.bill-remove-position-button', function () {
                $(this).closest('tbody tr').remove();
            });
            
            <?php
            // click add when the form first loads
            if (!Yii::$app->request->isPost && $model->bill->isNewRecord) 
              echo "$('#bill-new-position-button').click();";
            ?>
            
            // datepicker on existing rows
            $('#bill-positions').find('.addDatepicker').datepicker({
                "autoclose": true,
                "todayHighlight": true,
                "format": "yyyy-mm-dd",
                "orientation": "top left"
            });
            
        </script>
        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>

    </fieldset>


 
    <?= Html::submitButton('Save'); ?>
    <?php ActiveForm::end(); 
    
	$this->registerJs("        
    $(document).ready(function() {
        $(document).on('keyup', 'input', function(e){
            $(this).val($(this).val().replace(/[,]/g, '.'));
        });
    });
	");

    ?>

        

</div>            
