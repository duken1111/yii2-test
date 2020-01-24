<?php

namespace app\controllers;

use app\components\searchers\WarehouseSearcher;
use app\components\web\Controller;
use app\models\Price;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\NotFoundHttpException;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{

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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->production_date = date('d.m.Y');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel(Product::class, $id, ['prices', 'prices.warehouse']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'warehouses' => WarehouseSearcher::getFreeWarehousesForProduct($model)
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel(Product::class, $id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAddPrice($id)
    {
        $model = $this->findModel(Product::class, $id);

        if ($model->addPrice(Yii::$app->request->post('Price'))) {
            Yii::$app->session->setFlash('success', 'Добавлен товар на склад');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка добавления товара');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeletePrice($id)
    {
        $price = Price::findOne($id);

        if ($price && $price->delete()) {
            Yii::$app->session->setFlash('success', 'Товар удален со склада');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
