<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12 col-md-3">
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-12 col-md-3">
    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-xs-12 col-md-3">
    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>
    </div>

</div>
    <?= $form->field($model, 'work_hours')->textarea(['maxlength' => true, 'rows' => '5']) ?>

    <?= $form->field($model, 'adress')->textarea(['maxlength' => true, 'rows' => '4']) ?>

   <?php 
        echo $form->field($model, 'requisites')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'height' => 200,
                'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ]),
        ]); 
    ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'public')->textInput() ?>


    <?php // $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
