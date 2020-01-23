<?php

use kartik\date\DatePicker;
use app\models\Price;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$priceModel = new Price();
$this->registerJsFile(
    '@web/js/edit_price.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="product-form">
    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'production_date')->widget(DatePicker::class, [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]); ?>

            <?= $form->field($model, 'description')->textarea() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-7">
            <?php if ($model->prices): ?>
                <div class="prices">
                    <h3>Цены: </h3>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Склад</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th width="10%">Действия</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($model->prices as $price) : ?>
                            <tr>
                                <td>
                                    <a href="<?= Url::to(['warehouse/view', 'id' => $price->warehouse->id]); ?>"><?= $price->warehouse->name; ?></a>
                                </td>
                                <td><?= $price->price; ?></td>
                                <td><?= $price->quantity; ?></td>
                                <td>
                                    <a href="#" class="price-edit" data-id="<?=$price->id;?>" title="Изменить" aria-label="Изменить"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    <a href="<?=Url::to(['price/delete', 'id' => $price->id]);?>" title="Удалить" aria-label="Удалить" data-pjax="0" data-method="post" data-confirm="Вы действительно хотите удалить товар со склада?"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php  if(!$model->isNewRecord): ?>
                <?php $priceForm = ActiveForm::begin(['id' => 'price-create-form', 'action' => ['product/add-price', 'id' => $model->id]]); ?>
                    <?= $priceForm->field($priceModel, 'product_id')->hiddenInput(['value'=> $model->id])->label(false); ?>
                    <div class="row">
                        <div class="col-md-4"><?= $priceForm->field($priceModel, 'warehouse_id')->dropdownList($warehouses, ['prompt' => 'Укажите склад']) ?></div>
                        <div class="col-md-4"><?= $priceForm->field($priceModel, 'price')->textInput() ?></div>
                        <div class="col-md-4"><?= $priceForm->field($priceModel, 'quantity')->textInput() ?></div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Добавить цену', ['class' => 'btn btn-success']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php  if(!$model->isNewRecord): ?>
    <?php
    Modal::begin([
        'header' => 'Редактирование цены',
        'id' => 'price-modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'> </div>";
    Modal::end();
    ?>
<?php endif; ?>
