<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить альбом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage(); ?>
    <?php $gallery = $model->getImages(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'image',
                'value' => '
                    <div class="prod_img_button"  style="width:150px; display:inline-block;">
                        <a href="'.Url::to($img->getUrl('1500x')).'" class="product_image_btn lightbox">'.
                            Html::img($img->getUrl('150x'), ['alt' => $data->name, 'class' => 'product_image img-fluid']).
                            '<i class="fa fa-search-plus" aria-hidden="true" style="font-size: 20px; width: 100%; height: 100%; padding-top: 40px; padding-left: auto;"></i>
                        </a>
                    </div>',
                'format' => 'html',

            ],
            'name',
            'description',
            'meta_key',
            'public',
        ],
    ]) ?>
    <?php if($gallery[0]->filePath != 'no_image.jpg') { ?>

    <?php foreach ($gallery as $photo) { ?>

        <?php if($photo->isMain==0) { ?>
            <div class="prod_img_button" style="width:150px; display:inline-block;">
            <a href="<?= Url::to($photo->getUrl('1500x'))?>" class="product_image_btn lightbox" data-toggle="lightbox">
                <?= Html::img($photo->getUrl('150x'), ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
                <i class="fa fa-search-plus" aria-hidden="true" style="font-size: 20px; width: 100%; height: 100%; padding-top: 40px; padding-left: auto;"></i>
            </a>        
            </div>
        <?php } ?>
    <?php } ?>

    <?php } ?>
</div>
