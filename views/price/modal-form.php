<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $form = ActiveForm::begin(['id' => 'price-edit-form', 'action' => ['price/update', 'id' => $model->id]]); ?>
<div class="row">
    <div class="col-md-4"><?= $form->field($model, 'warehouse_id')->dropdownList($warehouses, ['prompt' => 'Укажите склад']) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'price')->textInput() ?></div>
    <div class="col-md-4"><?= $form->field($model, 'quantity')->textInput() ?></div>
</div>
<div class="form-group">
    <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    <a href="<?= Url::to(['price/delete', 'id' => $model->id]); ?>" class="btn btn-danger" data-method="post"
       data-confirm="Вы действительно хотите удалить товар со склада?">Удалить</a>
</div>
<?php ActiveForm::end(); ?>
