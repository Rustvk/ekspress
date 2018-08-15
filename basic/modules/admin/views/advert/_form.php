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
        <div class="main_public">
    <?= $form->field($model, 'public')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>
    </div>
   <?php 
        echo $form->field($model, 'text')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'height' => 200,
                'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ]),
        ]); 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
