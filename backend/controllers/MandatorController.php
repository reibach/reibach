<?php

namespace backend\controllers;

use backend\models\form\MandatorForm;
use Yii;
use backend\models\Mandator;
use backend\models\Address;
use backend\models\MandatorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MandatorController implements the CRUD actions for Mandator model.
 */
class MandatorController extends Controller
{
    /**
     * @inheritdoc
     */
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'index', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['create', 'delete', 'index', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mandator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MandatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mandator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mandator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$mandator = new Mandator();
		$address = new Address();
    
        if ($address->load(Yii::$app->request->post()) && $address->save()) {
			// Address ID holen
			$mandator->load(Yii::$app->request->post());
			$mandator->address_id = $address->id;
			//echo "Address-ID: ".$model->address_id;	
			$mandator->save();			
			return $this->redirect(['view', 'id' => $mandator->id]);
        } else {
            return $this->render('create', [
                'mandator' => $mandator,
                'address' => $address,

            ]);
        }
    }
    
    	
    /**
     * Updates an existing Mandator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

		$mandator = Mandator::findOne($id);
		// get the address_id of the mandator
        
        if (!$mandator) {
            throw new NotFoundHttpException("The mandator was not found: ".$mandator_id);
        }
        
        //$mandator_address_id = Mandator::findOne($mandator_id->id);
        //$address_mandator = Address::findOne($mandator_address_id->id);
        
        
        $address = Address::findOne($mandator->address_id);
     

        if ($mandator->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post())) {
            $isValid = $mandator->validate();
            $isValid = $address->validate() && $isValid;
            if ($isValid) {
                $mandator->save(false);
                $address->save(false);
                return $this->redirect(['mandator/view', 'id' => $id]);
            }
        }
        
        return $this->render('update', [
            'mandator' => $mandator,
            'address' => $address,
        ]);
    }

    /**
     * Deletes an existing Mandator model.
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
     * Finds the Mandator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mandator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mandator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
