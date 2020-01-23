<?php

use app\components\helpers\StringHelper;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'headerRowOptions'=> ['class'=>'kartik-sheet-style'],
        'columns' => [
            [
                'attribute' => 'production_date',
                'width' => '8%',
                'value' => function ($model) {
                    return $model->production_date . ' г.';
                }
            ],
            [
                'attribute' => 'name',
                'width' => '15%',
            ],
            [
                'attribute' => 'description',
                'width' => '15%',
                'value' => function ($model) {
                    return StringHelper::truncateByWord($model->description, 50, '...');
                }
            ],
            [
                'attribute' => 'prices',
                'format' => 'html',
                'value' => function ($model) {
                    return $this->render('/price/view', ['prices' => $model->activePrices]);
                }
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>


</div>
