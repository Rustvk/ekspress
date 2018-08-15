<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="main_public">
    <?= $form->field($model, 'public')->checkbox([ '0', '1', 'class'=>'is_boolean']) ?>
    </div>
    <?php $img = $model->getImage(); ?>
    <?php if($img->filePath != 'no_image.jpg') {?>
    <div>
    <?= Html::a('Удалить изображение', ['deletephoto', 'id' => $model->id, 'image'=>$img->id, 'g'=>0], ['class' => 'remove_gallery_image', 'data-id'=>$model->id, 'data-g'=>0, 'data-image' => $img->id]) ?><br>
    <img src="<?php echo $img->getUrl('150x')?>" alt="<?= $model->name ?>">
    </div>
    
    <?php } ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_key')->textInput(['maxlength' => true]) ?>

    <?php $gallery = $model->getImages(); ?>

    <?php // debug($gallery[0]->filePath == 'no_image.jpg'); ?>
    <?php if($gallery[0]->filePath == 'no_image.jpg') { ?>
    <?php } else { ?>
    <div class="row">
    <?php foreach ($gallery as $photo) { ?>
        <?php if($photo->isMain==0) { ?>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <?= Html::a('Удалить изображение', ['deletephoto', 'id' => $model->id, 'image'=>$photo->id, 'g'=>1], ['class' => 'remove_gallery_image', 'data-id'=>$model->id, 'data-g'=>1, 'data-image' => $photo->id]) ?>
            <img src="<?php echo $photo->getUrl('150x')?>" alt="<?= $model->name ?>">
        </div>
        <?php } ?>
    <?php } ?>
    </div>
    <?php } ?>
    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
