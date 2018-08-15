<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="main_public">
    <?= $form->field($model, 'public')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>
    </div>  
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-3">    
            <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-3">    
            <label>Дата</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'date',
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
            <?= $form->field($model, 'meta_key')->textInput() ?>
        </div>
        <div class="col-xs-12 col-md-5">    
            <?= $form->field($model, 'meta_desc')->textInput() ?>
        </div>
    </div>
   <?php 
        echo $form->field($model, 'description')->widget(CKEditor::className(), [
          'editorOptions' => [
                'height' => 200,
                'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]); 
    ?>


    <?php // $form->field($model, 'meta_title')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
