<?php

namespace app\api\controllers;

use app\components\presenters\ProductPresenter;
use app\models\Product;
use yii\rest\Controller;


class ProductController extends Controller {

    /**
     * @return array
     */
    public function actionIndex()
    {
        $products = Product::find()
            ->with(['prices', 'prices.warehouse'])
            ->asArray()
            ->orderBy(['production_date' => SORT_DESC])
            ->all();

        foreach ($products as &$product) {
            $product = (new ProductPresenter($product))->execute();
        }

        return $products;
    }
}