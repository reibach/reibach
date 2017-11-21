<?php

namespace frontend\controllers;

use frontend\models\form\OfferForm;
use frontend\models\form\BillForm;
use frontend\models\form\OfferMutate;
use frontend\models\SendForm;
use Yii;
use frontend\models\User;
use frontend\models\Bill;
use frontend\models\Offer;
use frontend\models\Address;
use frontend\models\Mandator;
use frontend\models\Customer;
use frontend\models\Part;
use frontend\models\OfferSearch;
use frontend\models\PartSearch;
use frontend\models\Position;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;


/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends Controller
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
     * Lists all Offer models.
     * @return mixed
     */
    public function actionIndex()
    {
		
			
		
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		print_r($mandator_active);
		echo "TESTME";
		
		$offer = Offer::find();
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			//$this->redirect(array('mandator/index'));
			$this->redirect(array('site/login'));
		}
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mandator_active' => $mandator_active,
            'offer' => $offer,
        ]);
    }


    /**
     * Displays a single Offer model.
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
		
		$offer = Offer::findOne($id);
		//Daten für eine Rechnung zusammenbauen:		
		
		//Kunde:
		// get Customer 
		$customer = Customer::findOne($offer->customer_id);
		$address_customer = Address::findOne($customer->address_id);

		//Mandant: 
		// get Mandator 
		
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

		$searchModel = new PartSearch();
        $dataProvider = $searchModel->searchOfferPart(Yii::$app->request->queryParams, $id);        
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'customer' => $customer,
            'address_mandator' => $address_mandator,
            'address_customer' => $address_customer,
            //'parts' => $parts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


   /**
     * Creates a new Offer model.
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

        $model = new OfferForm();
        $model->offer = new Offer;
        
        $model->offer->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

		
		$model->offer->mandator_id = $mandator_active;

		// erst die Rechnung speichern, dann die RechnungsID übergeben und die Part(en) speichern, sofern schon vorhanden  
        if (Yii::$app->request->post() && $model->save()) {
			// $model->saveParts();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Offer has been created: '.$model->offer->id));
            return $this->redirect(['update', 'id' => $model->offer->id]);
        }
        return $this->render('create', ['model' => $model]);
    }


    public function actionReporthtml($id) {
		
		$offer = Offer::findOne($id);
		//Daten für eine Rechnung zusammenbauen:
		//Kunde:
		// get Customer 
		$customer = Customer::findOne($offer->customer_id);
		$address_customer = Address::findOne($customer->address_id);


		//Mandant: 
		// get Mandator 		
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

		// Rechnung:
		// Teile:		
		//get all parts of an offer
		$searchModel = new PartSearch();
		
		//print_r(Yii::$app->request->queryParams);
		
        $dataProvider = $searchModel->searchOfferPart(Yii::$app->request->queryParams, $id);
        
		$listDataProvider = $dataProvider;
        
        
		//print_r($listDataProvider);
		//print_r($dataProvider);
        //exit;
        			
		// get your HTML raw content without any layouts or scripts
		return $this->render('_reportViewHtml', [
            'model' => $this->findModel($id),
            'customer' => $customer,
            'address_mandator' => $address_mandator,
            'address_customer' => $address_customer,
            //'parts' => $parts,
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listDataProvider' => $dataProvider,
        ]);
	
	//return $this->render('update', ['model' => $model]);
	}


    /**
     * Mutates an existing Offer model to a Bill model.
     * If mutate is successful, the browser will be redirected to the 'view' pageof the new bill.
     * @param integer $id
     * @return mixed
     */
    public function actionMutate($id)
    {
		$session = Yii::$app->session;
		$mandator_active = $session->get('mandator_active');
		
		// wenn kein mandant ausgewählt ist, Abbruch
		if ($mandator_active == '') {
			Yii::$app->session->setFlash('error',  Yii::t('app', 'No Mandator selected. Please select one.'));
			//return $this->redirect('/mandator/index');
			$this->redirect(array('mandator/index'));
		}

        $model = new OfferMutate();
        $model->offer = $this->findModel($id);       

		$bill_model = new BillForm();       
        $bill_model->bill = new Bill;        
        $bill_model->bill->loadDefaultValues();
        $bill_model->setAttributes(Yii::$app->request->post());        
        
		$bill_model->bill->mandator_id = $mandator_active;
		$bill_model->bill->customer_id = $model->offer->customer_id;
		$bill_model->bill->billing_date = $model->offer->offer_date;
		$bill_model->bill->description = $model->offer->description;
		
		$data = $model->offer->attributes;
		$bill_model->bill->setAttributes($data);
  
		 
		$position = new Position();
		 
        if ($bill_model->bill->save()) {	
			
			// Check, ob zu dem Angebot ATeile gehören 												
						
			// Bill Id zurueckgeben
			//echo "<p>Bill ID: </p>";
			//print_r($bill_model->bill->id);
			//echo "<p></p>";

			// die Teile des Angebots als Rechnungspositionen speichern
			//echo "<p></p>";
			//print_r($model->parts);
			
			$model_parts = (array) $model->parts;
			//print_r(array_keys($model_parts));
			//print_r($model_parts);
			
			$result = count($model->parts);			
			//var_dump($result);
			//echo "<p>RESULT: ".$result."</p>";
			
			for( $i= 0 ; $i < $result; $i++ )
			{	
				$position = new Position();

				//echo '<br>TEST' . $i . '<br>';
				//$position->bill_id = $model_parts[$i]['offer_id'];
				$position->bill_id = $bill_model->bill->id;
				$position->name = $model_parts[$i]['name'];
				$position->pos_num = $model_parts[$i]['part_num'];
				$position->quantity = $model_parts[$i]['quantity'];
				$position->unit = $model_parts[$i]['unit'];
				$position->comment = $model_parts[$i]['comment'];
				$position->price = $model_parts[$i]['price'];
				$position->taxrate = $model_parts[$i]['taxrate'];
		
				//echo '<br>Durchlauf:'.$i.'<br>';
				
				//echo '<p></p>';			
				$position->save();			
				//print_r($position);
				unset($position);
			}
		
				Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Offer has been mutated.'));
				return $this->redirect(['view', 'id' => $model->offer->id]);
    	}	
	}


			


    /**
     * Updates an existing Offer model.
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

        $model = new OfferForm();
        $model->offer = $this->findModel($id);       
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->save()) {
			 // $model->saveParts();
			
            Yii::$app->getSession()->setFlash('success',  Yii::t('app', 'Offer has been updated.'));
            return $this->redirect(['view', 'id' => $model->offer->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Offer model.
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
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
