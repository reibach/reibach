<?php

namespace frontend\controllers;

use frontend\models\form\BillForm;
use frontend\models\form\BillEMailForm;
use frontend\models\SendForm;
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
use yii\filters\AccessControl;


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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','report','reporthtml','view','update'],
                'rules' => [
                    [
                        'actions' => ['create','delete','index','report','reporthtml','view','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
		print_r($mandator_active);
		echo "TESTME";
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			//$this->redirect(array('mandator/index'));
			$this->redirect(array('site/login'));
		}

		// get Customer FullName		 
		$bill = Bill::find();
		
		//$customer = Customer::findOne($bill->customer_id);
		//$address_customer = Address::findOne($customer->address_id);


		//$searchModelPos = new PositionSearch();
        //$dataProviderPos = $searchModelPos->searchBillPos(Yii::$app->request->queryParams, $id).-;        
        
        //return $this->render('_indexview', [
            //'searchModel' => $searchModelPos,
            //'dataProvider' => $dataProviderPos,

        //]);

        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mandator_active' => $mandator_active,
            'bill' => $bill,
            //'customer' => $customer,
        ]);
    }

    /**
     * Displays a single Bill model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			$this->redirect(array('mandator/index'));
		}
		
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

		$searchModel = new PositionSearch();
        $dataProvider = $searchModel->searchBillPos(Yii::$app->request->queryParams, $id);        
        
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
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');

		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator.'));
			//print "ERROR: kein Mandant!!";
			//exit;
		}

        $model = new BillForm();
        //$model->position = new Position;
        $model->bill = new Bill;
        
        $model->bill->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

		
		$model->bill->mandator_id = $mandator_active;

        //if ($model->bill->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $model->bill->save() && $model->save()) {

		// erst die Rechnung speichern, dann die RechnungsID übergeben und die Position(en) speichern, sofern schon vorhanden  
        if (Yii::$app->request->post() && $model->save()) {
			// $model->savePositions();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Bill has been created: '.$model->bill->id));
            return $this->redirect(['update', 'id' => $model->bill->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

	
	
	/**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('app','Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays send page.
     *
     * @return mixed
     */
    public function actionSend($id)
    {
        $model = new SendForm();

        $bill = Bill::findOne($id);   

        $model->setAttributes(Yii::$app->request->post());
        
        // get Mandator 
		$mandator = Mandator::findOne($bill->mandator_id);
		//$mandator_address = Mandator::findOne($andator->address_id);
        
        
		// Rechnungsdatei, muss existieren
		$billdir =  '/var/www/html/'.$mandator->mandator_name.'/frontend/web/bills/MAN'.$mandator->id;
        $billfile =  $billdir.'/R_'.$bill->id.'.pdf'; 
        
		if (!file_exists($billfile))	
		{
			Yii::$app->session->setFlash('error', Yii::t('app', 'File does not exist').': R_'.$bill->id.'.pdf. '.Yii::t('app', 'Please save the bill before sending.'));
            
             return $this->redirect(['view',  'id' => $id]);
              //return $this->redirect(['view', 'id' => $model->bill->id])
 		}
		
		
		
		// get Customer 
		$customer = Customer::findOne($bill->customer_id);
		$customer_address = Address::findOne($customer->address_id);
        
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail($billfile)) {
                Yii::$app->session->setFlash('success', Yii::t('app','The bill has been sent by email.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('send', [
                'model' 			=> $model,
                'bill'  			=> $bill,
                'mandator'			=> $mandator,
       			'customer' 			=> $customer,
       			'customer_address' 	=> $customer_address,
            ]);
        }
    }


 
    /**
     * Updates an existing Bill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			$this->redirect(array('mandator/index'));
		}

        $model = new BillForm();
        $model->bill = $this->findModel($id);       
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->save()) {
			 // $model->savePositions();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Bill has been updated.'));
            return $this->redirect(['view', 'id' => $model->bill->id]);
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
    
    
    public function actionReportfile($id) {
		
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


		// Rechnungsdatei
		$billdir =  '/var/www/html/'.$mandator->mandator_name.'/frontend/web/bills/MAN'.$mandator->id;
        $billfile =  $billdir.'/R_'.$id.'.pdf'; 

		//$filename =  '/var/www/html/reibach/frontend/web/bills/MAN'.$mandator_id.'/R_'.$id.'.pdf';
			
		// delete old pdf-file	
		if (file_exists($billfile)) 
				unlink($billfile);

		// setup kartik\mpdf\Pdf component
		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => Pdf::MODE_UTF8, 
			// A4 paper format
			'format' => Pdf::FORMAT_A4, 
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT, 
			// stream to browser inline
			
			
			
			'filename' => $billfile,
			//'destination' => Pdf::DEST_BROWSER, 
			//'destination' => Pdf::DEST_DOWNLOAD, 
			'destination' => Pdf::DEST_FILE, 
			// your html content input
			'content' => $content,  
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting 
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			'cssInline' => '.kv-heading-1{font-size:18px}', 
			 // set mPDF properties on the fly
			'options' => ['title' => Yii::t('app', 'Bill')],
			 // call mPDF methods on the flyx
			'methods' => [ 
				'SetHeader'=>[Yii::t('app', 'Bill')], 
				'SetFooter'=>['{PAGENO}'],
				//'WriteHtml' => ['REIBACH'],
				'setWatermarkText' => ['Reibach'],
			]
		]);

		// return the pdf output as per the destination setting
		$pdf->render();
		
		if (file_exists($billfile)) {
		
			Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Bill has been saved.'));
		} else {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'Bill could not been saved.'));	
	
		}
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
			
			'filename' => 'R_'.$id.'.pdf',      
			
			//'destination' => Pdf::DEST_BROWSER, 
			'destination' => Pdf::DEST_DOWNLOAD, 
			//'destination' => Pdf::DEST_FILE, 
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

	

    public function actionReporthtml($id) {
		
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
		return $this->render('_reportViewHtml', [
            'model' => $this->findModel($id),
            'customer' => $customer,
            'address_mandator' => $address_mandator,
            'address_customer' => $address_customer,
            //'positions' => $positions,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listDataProvider' => $dataProvider,
        ]);
	
	//return $this->render('update', ['model' => $model]);
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
