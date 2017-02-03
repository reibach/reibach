<?php

namespace frontend\controllers;

use frontend\models\form\BillForm;
use Yii;
use frontend\models\Bill;
use frontend\models\Position;
use frontend\models\BillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bill model.
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
     * Creates a new Bill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    //public function actionCreate()
    //{
        //$model = new Bill();
        //$modelPosition = new Position();
        //$model->position = new Position();
        //$model->position->loadDefaultValues();


        //if ($model->load(Yii::$app->request->post()) && $modelPosition->load(Yii::$app->request->post()) && $model->save() && $modelPosition->save()) {
            //$model->created_at = time();
			//$model->updated_at = time();			
			
			//if ($model->save()) {
				//return $this->redirect(['view', 'id' => $model->id]);
			//} 
			
		//} else {
			//return $this->render('create', [
				//'model' => $model,
				//'modelPosition' => $modelPosition,
				
			//]);
		//}
	//}

    public function actionCreate()
    {
        $model = new BillForm();
        //$model->position = new Position;
        $model->bill = new Bill;
        
        $model->bill->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        //if ($model->bill->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) && $model->bill->save() && $model->save()) {

		// erst die Rechnung speichern, dann die RechnungsID übergeben und die Position(en) speichern, sofern schon vorhanden  
        if (Yii::$app->request->post() && $model->bill->save()) {
			$model->savePositions();
			
            Yii::$app->getSession()->setFlash('success', 'Bill has been created.'.$model->bill->id);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    //public function actionUpdate($id)
    //{
        //$model = new BillForm();
        //$model->bill = $this->findModel($id);
        
        //$model->setAttributes(Yii::$app->request->post());
        
        //if (Yii::$app->request->post() && $model->save()) {
            //Yii::$app->getSession()->setFlash('success', 'Bill has been updated.');
            //return $this->redirect(['update', 'id' => $model->bill->id]);
        //}
        //return $this->render('update', ['model' => $model]);
    //}
    
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
}
