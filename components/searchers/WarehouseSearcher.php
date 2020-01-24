<?php

namespace app\components\searchers;

use app\models\Product;
use app\models\Warehouse;
use yii\helpers\ArrayHelper;

class WarehouseSearcher
{
    /**
     * @param Product $product
     * @param array|null $skipedIds
     * @return array
     */
    public static function getFreeWarehousesForProduct(Product $product, array $skipedIds = null)
    {
        $ids = ArrayHelper::getColumn($product->prices, 'warehouse_id');

        if ($skipedIds) {
            $ids = array_filter($ids, function ($value) use ($skipedIds) {
                return !in_array($value, $skipedIds);
            });
        }

        $freeWarehouses =  Warehouse::find()
            ->where(['not in', 'id', $ids])
            ->asArray()
            ->all();

        return ArrayHelper::map($freeWarehouses, 'id','name');
    }
}