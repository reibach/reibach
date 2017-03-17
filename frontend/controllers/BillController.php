<?php

namespace frontend\controllers;

use frontend\models\form\BillForm;
use Yii;
use frontend\models\Bill;
use frontend\models\Address;
use frontend\models\Mandator;
use frontend\models\Customer;
use frontend\models\Position;
use frontend\models\BillSearch;
use frontend\models\PositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class BillController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Bill models.
     * @return mixed
     */
    public function actionIndex()
    {
		
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			$this->redirect(array('mandator/index'));
		}

        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mandator_active' => $mandator_active,
        ]);
    }




/*******************
	public function actionList()
    {
		$id = 82;
		$bill = Bill::findOne($id);
		//Daten für eine Rechnung zusammenbauen:
		//Kunde:
		// get Customer 
		$customer = Customer::findOne($bill->customer_id);
		$address_customer = Address::findOne($customer->address_id);


		//Mandant: 
		// get Mandator 
		
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

		//Rechnung:
		//Positionen:
		
		//get all positions of a bill
		//print_r($bill->id);
		//$positions = Bill::getBillPositions($id);
		
		//echo "<p>&nbsp;</p>";
		
		//print_r($positions);

		$searchModel = new PositionSearch();
        $dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);
		
        //$dataProvider = new ActiveDataProvider([
            //'query' => Position::find()->where(['bill_id' => $id])->orderBy('id DESC'),
            //'pagination' => [
                //'pageSize' => 10,
            //],
        //]);

        $this->view->title = 'Position List';
        return $this->render('list', ['listDataProvider' => $dataProvider]);
    }

******************/


    /**
     * Displays a single Bill model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		
		$bill = Bill::findOne($id);
		//Daten für eine Rechnung zusammenbauen:
		//Kunde:
		// get Customer 
		$customer = Customer::findOne($bill->customer_id);
		$address_customer = Address::findOne($customer->address_id);


		//Mandant: 
		// get Mandator 
		
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

		//Rechnung:
		//Positionen:
		
		//get all positions of a bill
		//print_r($bill->id);
		//$positions = Bill::getBillPositions($id);
		
		//echo "<p>&nbsp;</p>";
		
		//print_r($positions);

		$searchModel = new PositionSearch();
        $dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);
        
        
		//foreach ($positions as $key => $value) {
			//echo "Key: $key; Value: $value<br />\n";
		//}
		//print_r($positions);
		//exit;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'customer' => $customer,
            'address_mandator' => $address_mandator,
            'address_customer' => $address_customer,
            //'positions' => $positions,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

   /**
     * Creates a new Bill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BillForm();
        //$model->position = new Position;
        $model->bill = new Bill;
        
        $model->bill->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

			$session = Yii::$app->session;
			$mandator_active = $session->get('mandator_active');
		
			// wenn kein mandant ausgewählt ist, Abbruch
			if ($mandator_active == '') {
				Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator.'));
				//print "ERROR: kein Mandant!!";
				//exit;
			}
		$model->bill->mandator_id = $mandator_active;

        //if ($model->bill->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $model->bill->save() && $model->save()) {

		// erst die Rechnung speichern, dann die RechnungsID übergeben und die Position(en) speichern, sofern schon vorhanden  
        if (Yii::$app->request->post() && $model->bill->save()) {
			$model->savePositions();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Bill has been created: '.$model->bill->id));
            return $this->redirect(['update', 'id' => $model->bill->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

	

    /**
     * Updates an existing Bill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new BillForm();
        $model->bill = $this->findModel($id);
       
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->bill->save()) {
			$model->savePositions();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Bill has been updated.'));
            return $this->redirect(['update', 'id' => $model->bill->id]);
        }
        return $this->render('update', ['model' => $model]);
    }
    
    /**
     * Deletes an existing Bill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        throw new HttpException(404, 'The requested page does not exist.');
    }
    
    
    public function actionReport($id) {
		
		$bill = Bill::findOne($id);
		//Daten für eine Rechnung zusammenbauen:
		//Kunde:
		// get Customer 
		$customer = Customer::findOne($bill->customer_id);
		$address_customer = Address::findOne($customer->address_id);


		//Mandant: 
		// get Mandator 		
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

		//Rechnung:
		//Positionen:		
		//get all positions of a bill
		$searchModel = new PositionSearch();
        $dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);
		$listDataProvider = $dataProvider;
        			
		// get your HTML raw content without any layouts or scripts
		$content = $this->renderPartial('_reportView', [
            'model' => $this->findModel($id),
            'customer' => $customer,
            'address_mandator' => $address_mandator,
            'address_customer' => $address_customer,
            //'positions' => $positions,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listDataProvider' => $dataProvider,
        ]);


		// setup kartik\mpdf\Pdf component
		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => Pdf::MODE_UTF8, 
			// A4 paper format
			'format' => Pdf::FORMAT_A4, 
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT, 
			// stream to browser inline
			'destination' => Pdf::DEST_BROWSER, 
			// your html content input
			'content' => $content,  
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting 
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			'cssInline' => '.kv-heading-1{font-size:18px}', 
			 // set mPDF properties on the fly
			'options' => ['title' => Yii::t('app', 'Bill')],
			 // call mPDF methods on the fly
			'methods' => [ 
				'SetHeader'=>[Yii::t('app', 'Bill')], 
				'SetFooter'=>['{PAGENO}'],
				//'WriteHtml' => ['REIBACH'],
				'setWatermarkText' => ['Reibach'],
			]
		]);
		
		
		//'methods' => [ 
				//'SetHeader' => [Yii::t('app', 'Bill')], 
				//'SetFooter' => ['{PAGENO}'],
				//'setWatermarkText' => ['Reibach']
				//'SetWaterMarkImage'=>['http://172.22.119.118/reibach/frontend/web/images/reibach-logo-460x460_33.png'],
				//'showWatermarkImage'=>['true'],
				 
			//]
		//]);
		
		//$pdf->setWatermarkText('BLABLA', 1);
		//$pdf->showWatermarkText = true;
		//$pdf->setWatermarkImage('watermark.png');
		//$pdf->watermarkImageAlpha = 0.5;
		//$pdf->howWatermarkImage = true;


		// return the pdf output as per the destination setting
		return $pdf->render(); 
	}

	// Privacy statement output demo
	public function actionMpdfDemo1() {
		$pdf = new Pdf([
			'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
			'content' => $this->renderPartial('privacy'),
			'options' => [
				'title' => 'Privacy Policy - Krajee.com',
				'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
			],
			'methods' => [
				'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
				'SetFooter' => ['|Page {PAGENO}|'],
			]
		]);
		return $pdf->render();
	}
}
