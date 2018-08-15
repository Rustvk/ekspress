<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\LunchCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lunch-categories-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="main_public">
        <?= $form->field($model, 'public')->checkbox(['0', '1', 'class'=>'is_boolean']) ?>
	</div>
    <div class="row">
        <div class="col-xs-12 col-sm-8">
          <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>

    <!-- <?php // $form->field($model, 'description')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
