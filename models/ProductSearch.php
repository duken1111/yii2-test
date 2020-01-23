<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $dateRange;
    public $dateStart;
    public $dateEnd;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 3],
            [['dateRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/']
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class'                 => DateRangeBehavior::class,
                'dateStartFormat'       => 'Y-m-d',
                'dateEndFormat'         => 'Y-m-d',
                'attribute'             => 'dateRange',
                'dateStartAttribute'    => 'dateStart',
                'dateEndAttribute'      => 'dateEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find()
            ->with(['activePrices', 'activePrices.warehouse'])
            ->orderBy(['production_date' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['>=', 'production_date', $this->dateStart])
            ->andFilterWhere(['<=', 'production_date', $this->dateEnd]);

        return $dataProvider;
    }
}
