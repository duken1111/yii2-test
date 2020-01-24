<?php

namespace app\components\presenters;

use app\components\helpers\ArrayHelper;


/**
 * Class ProductPresenter
 * @package app\components\presenters
 */
class ProductPresenter
{
    protected $product;

    public function __construct(array $product)
    {
        $this->product = $product;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $this->formatPrices();
        $this->product = ArrayHelper::removeKeys($this->product, ['id', 'created_at', 'updated_at', 'production_date']);

        return $this->product;
    }

    protected function formatPrices()
    {
        if (!array_key_exists('prices', $this->product)) {
            return;
        }

        foreach ($this->product['prices'] as &$price) {
            $price['stock_code'] = $price['warehouse']['code'];
            $price['stock_name'] = $price['warehouse']['name'];

            $price = ArrayHelper::removeKeys($price, ['id', 'quantity', 'warehouse_id', 'product_id', 'warehouse']);
        }
    }
}