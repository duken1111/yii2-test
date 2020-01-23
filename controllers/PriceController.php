<?php

namespace app\controllers;

use app\components\searchers\WarehouseSearcher;
use app\components\web\Controller;
use app\models\Price;
use Yii;
use yii\web\NotFoundHttpException;


/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
{

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Товар обновлен');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка обновления');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionGetModalForm($id) {
        $model = $this->findModel($id);

        return $this->renderAjax('modal-form', [
            'model' => $model,
            'warehouses' => WarehouseSearcher::getFreeWarehousesForProduct($model->product, [$model->warehouse_id])
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
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Товар удален со склада');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
