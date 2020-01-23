<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить склад', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'headerRowOptions'=> ['class'=>'kartik-sheet-style'],
        'columns' => [
            [
                'attribute' => 'code'
            ],
            [
                'attribute' => 'name'
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ],
    ]); ?>

</div>
