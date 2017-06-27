<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Address;
use frontend\models\Customer;
use frontend\models\Mandator;
use frontend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','view','update'],
                'rules' => [
                    [
                        'actions' => ['create','delete','index','view','update'],
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
		$session = Yii::$app->session;
		if ($session->has('mandator_active')) {
			print "<p>mandator_active</p>:".$session->get('mandator_active');
			$mandator_active = $session->get('mandator_active');
	
		}
		// check if a session is already open
		//if ($session->isActive) {
			//print "Session is active<br>";
			//print_r($session);
			//print "<p>----</p>";

			// destroys all data registered to a session.
			//$session->destroy();
			//print "<p>mandator_active</p>:".$session->get('mandator_active');

			// close a session
			//$session->close();
			//print "Session is closed<br>";
			//print "<p>----</p>";
			//print "<p>mandator_active</p>:".$session->get('mandator_active');
			
		//} else {
			//print "Session is NOT active<br>";
		//}	
			

		// wenn kein mandant ausgewählt ist, Abbruch
		//if ($mandator_active == '') {
			//Yii::$app->session->setFlash('error', 'No Mandator selected. Please select one.');
			//return $this->redirect('/mandator/index');
			//$this->redirect(array('mandator/index'));
		//}

        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mandator_active' => $mandator_active,
            
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$customer = Customer::findOne($id);
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
		$address_mandator = Address::findOne($mandator->address_id);

   
        return $this->render('view', [
            'model' => $this->findModel($id),
            //'address' => $address,
			'address_mandator' => $address_mandator,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $customer = new Customer();
       
        
        $address = new Address();
		$address->address_type = 'CUSTOMER';
		// erst die Addresse speichern, dann die AddressID übergeben und dann den Kunden speichern  
        if ($address->load(Yii::$app->request->post()) && $address->save()) {
			// Address ID holen
			$customer->load(Yii::$app->request->post());
			$customer->address_id = $address->id;
		
		
			$session = Yii::$app->session;
			$mandator_active = $session->get('mandator_active');
		
			// wenn kein mandant ausgewählt ist, Abbruch
			if ($mandator_active == '') {
				print "ERROR: kein Mandant!!";
				exit;
			}
			$customer->mandator_id = $mandator_active;
			$customer->save();			
			return $this->redirect(['view', 'id' => $customer->id]);
        } else {
            return $this->render('_createForm', [
                'customer' => $customer,
                'address' => $address,

            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $customer = Customer::findOne($id);
		// get the address_id of the mandator
        $mandator_id = $customer->mandator_id;
        $mandator = Mandator::findOne($mandator_id);
         
        if (!$customer) {
            throw new NotFoundHttpException("The customer was not found.");
        }
        
        if (!$mandator) {
            throw new NotFoundHttpException("The mandator was not found: ".$mandator_id);
        }        
        
        $address = Address::findOne($customer->address_id);
        $address_mandator = Address::findOne($mandator->address_id);
        
        
        if (!$address_mandator) {
            throw new NotFoundHttpException("The Mandator has no address.");
        }
        
        if (!$address) {
            throw new NotFoundHttpException("The customer has no address.");
        }
        
        //$customer->scenario = 'update';
        //$address->scenario = 'update';

        if ($address->load(Yii::$app->request->post()) && $address->save()) {
			if ($customer->load(Yii::$app->request->post()) && $customer->save()) {
				$customer->save();
			}
            return $this->redirect(['customer/view', 'id' => $id]);
        } else {		
			return $this->render('update', [
				'customer' => $customer,
				'address' => $address,
				'address_mandator' => $address_mandator,
			]);
		}
    }    
        
        
    
    /**
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
