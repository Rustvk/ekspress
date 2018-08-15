<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CategoriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'meta_key') ?>

    <?php // echo $form->field($model, 'meta_desc') ?>

    <?php echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'public') ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'back_image') ?>

    <?php // echo $form->field($model, 'public_in_menu') ?>

    <?php // echo $form->field($model, 'public_in_cat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
