<?php

namespace backend\controllers;

use Yii;
use backend\models\Address;
use backend\models\Customer;
use backend\models\Mandator;
use backend\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

   
		
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
			//echo "Address-ID: ".$model->address_id;	
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
        
        //$mandator_address_id = Mandator::findOne($mandator_id->id);
        //$address_mandator = Address::findOne($mandator_address_id->id);
        
        
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
        
        if ($customer->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post())) {
            $isValid = $customer->validate();
            $isValid = $address->validate() && $isValid;
            if ($isValid) {
                $customer->save(false);
                $address->save(false);
                return $this->redirect(['customer/view', 'id' => $id]);
            }
        }
        
        return $this->render('update', [
            'customer' => $customer,
            'address' => $address,
            //'address_customer' => $address_customer,
            'address_mandator' => $address_mandator,
        ]);
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
