<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1>Категория: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            [
                'attribute' => 'parent_id',
                'value' => $model->category->name ? $model->category->name: 'Нет родителя'
            ],            
            'description',
            'meta_key',
            'order_num',
            [
            'attribute'=>'image',
            'value' => function($data) { 
                // '<a href='.Url::to('@web/img/products/1500/'.$model->image).'data-toggle="lightbox" class="product_image_btn">'.
                    if ($data->image) { 
                        return Html::img('@web/images/categories/266/'.$data->image.'', ['alt' => $data->name, 'class' => 'product_image img-fluid']);
                    } else {
                      return Html::img('@web/images/categories/266/no-image.jpg', ['alt' => $data->name, 'class' => 'product_image img-fluid']);
                    }
                // .'<i class="fa fa-search-plus" aria-hidden="true"></i>
                // </a>',
                },
            'format'=>'html',
            ], 
            [
            'attribute'=>'back_image',
            'value' => function($data) { 
                // '<a href='.Url::to('@web/img/products/1500/'.$model->image).'data-toggle="lightbox" class="product_image_btn">'.
                    if ($data->back_image) { 
                        return Html::img('@web/images/categories/1500/'.$data->back_image.'', ['alt' => $data->name, 'class' => 'product_image img-fluid col-xs-12 back_img']);
                    } else {
                      return Html::img('@web/images/categories/1500/back_image.jpg', ['alt' => $data->name, 'class' => 'product_image img-fluid col-xs-12 back_img']);
                    }
                // .'<i class="fa fa-search-plus" aria-hidden="true"></i>
                // </a>',
                },
            'format'=>'html',
            ], 

            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ], 
            // 'class',
            // 'image',
            [
                'attribute'=>'public_in_menu',
                'value' => checkPublic($model->public_in_menu),
            ],             
            [
                'attribute'=>'public_in_cat',
                'value' => checkPublic($model->public_in_cat),
            ],             
        ],
    ]) ?>

</div>
