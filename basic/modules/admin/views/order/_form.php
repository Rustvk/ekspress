<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="order-form">
    <?php $form = ActiveForm::begin(); ?>
   <div class="row">
        <div class="col-xs-12 col-md-3">    
            <label>Дата создания</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'created_at',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
            ]);
            ?><br>
        </div>
        <div class="col-xs-12 col-md-3">    
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-9999',
            ]) ?>
        </div>
        <div class="col-xs-12 col-md-2">    
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>        
        <div class="col-xs-12 col-md-4">    
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
   </div>

   <?php 
        echo $form->field($model, 'message')->widget(CKEditor::className(), [
          'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'height' => 200,
                'preset' => 'standart', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ]),
        ]); 
    ?>
   <div class="row">
        <div class="col-xs-12 col-md-3">   
            <label>Дата выполнения</label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'to_date',
                'value' => date('Y-m-d'),
                'options' => ['placeholder' => 'Выберите дату'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
            ]);
            ?><br>
        </div>
        <div class="col-xs-12 col-md-2">   
            <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-2">    
            <?= $form->field($model, 'summ')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-2">    
            <?= $form->field($model, 'status')->dropDownList([ 1 => 'Активен', 2 => 'Завершен'], ['prompt' => '']) ?>
        </div>
        <div class="col-xs-12 col-md-3">    
            <?= $form->field($model, 'type')->dropDownList([ 'Банкет' => 'Банкет', 'Заказ' => 'Заказ на вынос', 'Обед' => 'Обед', ], ['prompt' => '']) ?>
        </div>        
    </div>
        <?php // $form->field($model, 'products_ids')->checkboxList($products, ['class' => 'checkingred'])->label('Выбрать блюда') ?>

    <div class="form-group">
        <?php if (!$model->isNewRecord) { ?>
        <div class="btn btn-default getorderitems" id="<?= $model->id?>">Выбрать блюда</div>
        <?php } else { ?>
        <span>Выбор блюд будет доступен после сохранения заказа</span><br><br>
        <?php } ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<div class="overlay"></div>
<div class="orderitems">
</div>
