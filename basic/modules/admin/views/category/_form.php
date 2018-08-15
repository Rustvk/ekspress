<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="main_public">
    <?= $form->field($model, 'public')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="form-group field-category-parent_id has-success">
                <label for="category-parent_id" class="control-label">Родительская категория</label>
                <select name="Categories[parent_id]" id="category-parent_id" class="form-control">
                    <option value="0">Без родителя</option>
                    <?= app\components\CategoryMenuWidget::widget(['tpl'=>'select', 'model'=>$model]) ?>
                </select>
            </div>        
        </div>        
    </div>
    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows'=>3]) ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'order_num')->textInput() ?>
        </div>        
    </div>
    <?php // $form->field($model, 'parent_id')->textInput() ?>

    <?php // echo $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Categories::find()->all(), 'id', 'name')) ?>
    



    <?php // $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?php 
        if (($model->image)&&($model->image!='no-image.jpg')) {
        echo '<div class="upd_img1"><a href='.Url::to(['category/delimage', 'id'=>$model->id, 'image'=>'image']).' id='.$model->id.' data-image="image" style="vertical-align:top;" class="cdelimg"> Удалить изображение</a><br>';
        echo Html::img('@web/images/categories/266/'.$model->image.'', ['alt' => $model->name, 'class' => 'product_image img-fluid']);
        echo '</div>';
        echo $form->field($model, 'img')->fileInput();
    } else {
        echo $form->field($model, 'img')->fileInput();
    }
    ?>  

    <?php 
        if (($model->back_image)&&($model->back_image!='back_image.jpg')) {
        echo '<div class="upd_img2"><a href='.Url::to(['category/delimage', 'id'=>$model->id, 'image'=>'back_image']).' id='.$model->id.' style="vertical-align:top;" data-image="back_image" class="cdelimg"> Удалить изображение</a><br>';
        echo Html::img('@web/images/categories/1500/'.$model->back_image.'', ['alt' => $model->name, 'class' => 'product_image img-fluid  col-xs-12 back_img']);
        echo '</div>';
        echo $form->field($model, 'back_img')->fileInput();
    } else {
        echo $form->field($model, 'back_img')->fileInput();
    }
    ?>  

    <?= $form->field($model, 'public_in_menu')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>

    <?= $form->field($model, 'public_in_cat')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
