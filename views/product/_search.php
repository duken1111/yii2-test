<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->field($model, 'dateRange', [
                'options' => [
                    'class' => 'drp-container form-group'
                ]
            ])->widget(DateRangePicker::class, [
                'convertFormat' => true,
                'language' => 'ru',
                'pluginOptions' => [
                    'locale' => [
                        'format' => 'd.m.Y',
                        'separator' => ' - ',
                    ]
                ]
            ])->label('С какое по какое');
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс', 'index', ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
