<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="product-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="main_public">
    <?= $form->field($model, 'public')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>
    </div>   
    <div> 
        <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
        <?php 
            if (($model->image)&&($model->image!='no-image.jpg')) {
            echo '<div class="upd_img"><a href='.Url::to(['product/delimage', 'id'=>$model->id]).' id='.$model->id.' style="vertical-align:top;" class="delimg"> Удалить изображение</a>';
            echo Html::img('@web/images/products/266/'.$model->image.'', ['alt' => $model->name, 'class' => 'product_image img-fluid']);
            echo '</div>';
            echo $form->field($model, 'img')->fileInput();
        } else {
            echo $form->field($model, 'img')->fileInput();
        }
        ?>    
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">    
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-xs-12 col-md-3">    
        <?= $form->field($model, 'price')->textInput()->label('Цена (Руб.)') ?>
        </div>

        <div class="col-xs-12 col-md-3">    
        <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->label('Вес (указать ед.измерения)') ?> 
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6"> 
                <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
                <div class="form-group field-product-category_id has-success" style="margin-bottom:21px;">
                    <label for="product-category_id" class="control-label">Категория</label>
                    <select name="ProductWithIngredients[category_id]" id="product-category_id" class="form-control">
                        <option value="0"></option>
                        <?= app\components\CategoryMenuWidget::widget(['tpl'=>'cat_select_product', 'model'=>$model]) ?>
                    </select>
                </div>
                <?php } ?>
                <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
                    <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>
                <?php } ?>                
        </div>
        <div class="col-xs-12 col-md-6"> 
            <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
            <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows'=>5]) ?>
            <?php } ?>
        </div>
    </div>

    <?php if (($model->parent_id>0)OR($parent>0)){  ?>
    <?= $form->field($model, 'parent_id')->textInput(['value'=> $parent, 'type'=>'hidden'])->label(''); ?>
    <?php } else { ?>
    <?= $form->field($model, 'parent_id')->textInput(['value'=> 0, 'type'=>'hidden'])->label(''); ?>
    <?php } ?>
    <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
    <?= $form->field($model, 'popular')->checkbox(['0', '1', 'class'=>'is_boolean']) ?>
    <?php } ?>

    <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
    <?= $form->field($model, 'child')->checkbox(['0', '1', 'class'=>'is_boolean']) ?>
    <?php } ?>
    <?php if ($model->daughterProducts) { } else {  ?>
    <div class="btn btn-default show_ingred">Выбрать ингредиенты</div>
    <div class="ingred">
        <div class="close_ing close_ingred">✕</div>
        <?= $form->field($model, 'ingredients_ids')->checkboxList($ingredients, ['class' => 'checkingred'])->label('Ингредиенты') ?>
        <div class="footer_ing">
            <div class="close_ing done_ing btn btn-primary"><i class="fa fa-angle-left"></i> Готово</div>
        </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
        <?php if (!$model->isNewRecord) { ?>

    <?php if (($model->parent_id>0)OR($parent>0)) { } else { ?>
    <div>Сохраните изменения прежде чем создавать или редактировать виды блюд</div>
    
        <h2>Виды блюда</h2>
        <div class="row col-xs-12 daughter_container">
        <?php 
            foreach ($model->daughterProducts as $daughter) { ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 daughter_block">
                    <div class="daughter">
                        <h4><?=$daughter->name?></h4>
                        <p>Цена: <?=$daughter->price?> руб.</p>
                        <p>Вес: <?=$daughter->weight?></p>
                        <?php $ing = '';
                            foreach ($daughter->ingredients as $ingredient) {
                                 // debug($daughter);
                                $ing .= '<span>'. $ingredient['name']. ' | </span>';
                            }
                            echo $ing;
                         ?>
                        <p>Опубликовано: <?= checkPublic($daughter->public)?></p>
                        <?= Html::a('Редактировать', ['update', 'id' => $daughter->id], ['class' => 'btn btn-default change_daughter', 'target'=>'_blank']) ?>
                        <?= Html::a('<i class="fa fa-close text-danger"></i>', ['delete', 'id' => $daughter->id], ['class' => 'remove_daughter', 'target'=>'_blank', 'id' => $daughter->id]) ?>
                    </div>
                </div>
        <?php } ?>
        </div>
    <?= Html::a('Создать вид блюда', ['create', 'parent' => $model->id], ['class' => 'btn btn-default create_daughter', 'target'=>'_blank']) ?>
        <?php } ?>
    <?php } ?>
    

</div>
<div class="overlay"></div>