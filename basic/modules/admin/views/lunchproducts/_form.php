<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\lunchProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lunch-products-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="main_public">
        <?= $form->field($model, 'public')->checkbox(['0', '1', 'class'=>'is_boolean']) ?>
    </div>    
    <?php 
        if (($model->image)&&($model->image!='no-image.jpg')) {
        echo '<div class="upd_img"><a href='.Url::to(['lunchproducts/delimage', 'id'=>$model->id]).' id='.$model->id.' style="vertical-align:top;" class="delimglunch"> Удалить изображение</a>';
        echo Html::img('@web/images/lunchproducts/266/'.$model->image.'', ['alt' => $model->name, 'class' => 'product_image img-fluid']);
        echo '</div>';
        echo $form->field($model, 'img')->fileInput();
    } else {
        echo $form->field($model, 'img')->fileInput();
    }
    ?>     
    <div class="row">
        <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-xs-12 col-sm-3">
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-xs-12 col-sm-3">
        <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php // $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="form-group field-lunchproducts-lunch_category_id has-success">
                <label for="lunchproducts-lunch_category_id" class="control-label">Категория</label>
                <select name="LunchProducts[lunch_category_id]" id="lunchproducts-lunch_category_id" class="form-control">
                    <option value="0"></option>
                    <?= app\components\LunchCategoryMenuWidget::widget(['tpl'=>'lunch_cat_select_product', 'model'=>$model]) ?>
                </select>
            </div>
        </div>
        <?php // $form->field($model, 'lunch_category_id')->textInput() ?>
        <div class="col-xs-12 col-sm-3">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
