<?php

namespace app\controllers\api;


use app\components\presenters\ProductPresenter;
use app\models\Product;
use yii\rest\Controller;
use yii\web\XmlResponseFormatter;

class ProductController extends Controller
{
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