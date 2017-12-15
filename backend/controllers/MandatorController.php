<?php

namespace backend\controllers;

use Yii;
use frontend\models\Offer;
use backend\models\Address;
use frontend\models\User;
use backend\models\Aaa;
use backend\models\Mandator;
use backend\models\Mundator;
use backend\models\MandatorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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

 public function actionSignup()
    {
		$model = new Mandator();
        $model->mandator_name = 'testname';	
		print "<BR>mandator_name: ".$model->mandator_name;

		$model->user_id = '54';
		print "<br>UserID: ".$model->user_id;

		$model->address_id = '10';	
		print "<BR>AddressID: ".$model->address_id;

		$model->taxable = '0';	
		print "<BR>taxable: ".$model->taxable;

		$model->b_id = '0';	
		print "<BR>B_ID: ".$model->b_id;

		$model->c_id = '0';	
		print "<BR>C_ID: ".$model->c_id;

		$model->signature = 'not blank';	
		print "<BR>signature: ".$model->signature;

		print "<br>MandatorID: ".$model->id;
				
        $model->save();	
		print "<br>MandatorID: ".$model->id;
        print "<br>MandatorID: ".$model['id'];

		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			print "<br>MandatoraaaID: ".$model['id'];
		} else {
			print "<br>MandatorbbbID: ".$model->id;
		}
					
   		exit;


	}

    /**
     * Creates a new Mandator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		//$user = new User();
		//$user -> save();


		$aaa = new Aaa();
		$aaa -> save();
		print "<BR>AaaID: ".$aaa->id;

		$address = new Address();
		$address -> save();
		print "<BR>AddressID: ".$address->id;


        $offer = new Offer();
		$offer -> save();
		print "<BR>OfferID: ".$offer->id;


        $mandator = new Mundator();
		$mandator -> save();


        $model = new Mandator();
        
        //print_r(Yii::$app->request->post());
		
		//[Mandator] => Array ( [mandator_name] => reibachfff [user_id] => 54 [address_id] => 103 [taxable] => [b_id] => [c_id] => [signature] => dfdf )  
		//				Array ( [mandator_name] => testname [user_id] => 54 [address_id] => 10 [taxable] => 0 [b_id] => 0 [c_id] => 0 [signature] => not blank )
		$model->mandator_name = 'testname';	
		//print "<BR>mandator_name: ".$model->mandator_name;

		$model->user_id = '54';
		//print "<br>UserID: ".$model->user_id;

		$model->address_id = '10';	
		//print "<BR>AddressID: ".$model->address_id;

		$model->taxable = '0';	
		//print "<BR>taxable: ".$model->taxable;

		$model->b_id = '0';	
		//print "<BR>B_ID: ".$model->b_id;

		$model->c_id = '0';	
		//print "<BR>C_ID: ".$model->c_id;

		$model->signature = 'not blank';	
		//print "<BR>signature: ".$model->signature;

		//print "<br>MandatorID: ".$model->id;
		
		$model->load($model);
		print_r($model);
		$model->save();
		exit; 
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        //} else {
            //return $this->render('create', [
                //'model' => $model,
            //]);
        //}
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
