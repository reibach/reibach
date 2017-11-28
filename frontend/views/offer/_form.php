<?php
//namespace yii\jui;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Customer;
use frontend\models\Part;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">
	
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

    <?= $form->field($model->offer, 'customer_id')->dropDownList(
		ArrayHelper::map(Customer::find()
		->where(['mandator_id' => $mandator_active])
		->all(),'id','fullName'),
		['prompt'=>Yii::t('app','Select Customer')])
		->label(false) ?>
    </fieldset>
   
	<?php
        //echo $form->field($model->offer, 'updated_at')->widget(DatePicker::className(), [
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

<p><?= Yii::t('app', 'Offer Date') ?></p>

<?php 
	echo DatePicker::widget([
    'model' => $model->offer,
    'attribute' => 'offer_date',
    'language' => 'de',
    //'dateFormat' => 'dd.MM.yyyy',
    'dateFormat' => 'yyyy-MM-dd',
    //'saveFormat' => 'php:Y-m-d'
]);

?>
	
	
	<fieldset>
	<legend>
	
	<?= $form->field($model->offer, 'description')->textArea(['rows' => '4']) ?>
	</legend>
	</legend>
		
	<fieldset>
	<legend><?= Yii::t('app','Offer Parts'); ?>
		<?php
		// new part button
		echo Html::a(Yii::t('app','New Part'), 'javascript:void(0);', [
		  'id' => 'offer-new-part-button', 
		  'class' => 'pull-right btn btn-default btn-xs'
		])
		?>
	</legend>
	
		<?php     
	    // part table
        $part = new Part();
        $part->loadDefaultValues();
        echo '<table id="offer-parts" class="table table-condensed table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','part_num')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','name')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','quantity')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','unit')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','comment')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','price')) . '</th>';
        echo '<th>' . $part->getAttributeLabel(Yii::t('app','taxrate')) . '</th>';
        //echo '<td>&nbsp;</td>';
        echo '</tr>';
        echo '</thead>';
        echo '</tbody>';
        
        //print_r($model->parts);
        //print_r($_parts);
        
        // existing parts fields
        foreach ($model->parts as $key => $_part) {
          echo '<tr>';
          echo $this->render('_form-offer-part', [
            'key' => $_part->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_part->id,
            'form' => $form,
            'part' => $_part,
          ]);
          echo '</tr>';
        }
        
        
        // new part fields
        echo '<tr id="offer-new-part-block" style="display: none;">';
        echo $this->render('_form-offer-part-new', [
            'key' => '__id__',
            'form' => $form,
            'part' => $part,
            
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        
         // register JS assets required for widgets
		//\zhuravljov\widgets\DatePickerAsset::register($this);
        ?>
        <?php ob_start(); // output buffer the javascript to register later ?>
        <script>
            // add part button
            var part_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
           
            $('#offer-new-part-button').on('click', function () {
				part_k += 1;
                $('#offer-parts').find('tbody')
                  .append('<tr>' + $('#offer-new-part-block').html().replace(/__id__/g, 'new' + part_k) + '</tr>');
                
                // datepicker on copied row
                //$('#Parts_new' + part_k + '_date_ordered').datepicker({
                    //"autoclose": true,
                    //"todayHighlight": true,
                    //"format": "yyyy-mm-dd",
                    //"orientation": "top left"
                //});
                
            });
            
            // remove part button
            $(document).on('click', '.offer-remove-part-button', function () {
                $(this).closest('tbody tr').remove();
            });
            
            <?php
            // click add when the form first loads
            if (!Yii::$app->request->isPost && $model->offer->isNewRecord) 
              echo "$('#offer-new-part-button').click();";
            ?>
            
            // datepicker on existing rows
            $('#offer-parts').find('.addDatepicker').datepicker({
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
