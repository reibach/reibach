<?php

namespace frontend\controllers;

use Yii;
use frontend\models\form\ProductForm;
use frontend\models\Product;
use frontend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    //public function actionCreate()
    //{
        //$model = new Product();

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        //} else {
            //return $this->render('create', [
                //'model' => $model,
            //]);
        //}
    //}


	 public function actionCreate()
    {
        $model = new ProductForm();
        $model->product = new Product;
        $model->product->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());
        
        if (Yii::$app->request->post() && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Product has been created.');
            return $this->redirect(['update', 'id' => $model->product->id]);
        }
        return $this->render('create', ['model' => $model]);
    }



    /**
     * Updates an existing Product model.
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
        //$model = new ProductForm();
        //$model->product = $this->findModel($id);
        //$model->setAttributes(Yii::$app->request->post());
        
        //if (Yii::$app->request->post() && $model->save()) {
            //Yii::$app->getSession()->setFlash('success', 'Product has been updated.');
            //return $this->redirect(['update', 'id' => $model->product->id]);
        //}
        //return $this->render('update', ['model' => $model]);
    //}
    
    
    

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    //protected function findModel($id)
    //{
        //if (($model = Product::findOne($id)) !== null) {
            //return $model;
        //} else {
            //throw new NotFoundHttpException('The requested page does not exist.');
        //}
    //}

	protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new HttpException(404, 'The requested page does not exist.');
    }

}
