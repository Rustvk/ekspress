<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div>
        <?= $form->field($model, 'zadiak')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-4">
            <label>Дата приема</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'start',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
            ]);
            ?><br>
        </div>
        <div class="col-xs-12 col-md-4">
            <label>Дата увольнения</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'end',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
            ]);
            ?><br>
        </div>
        <div class="col-xs-12 col-md-4">
            <label>День рождения</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'birthday',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
            ]);
            ?><br>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
