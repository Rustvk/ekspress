<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1>Блюдо: <?= $model->name ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данное блюдо?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'image',
                'value' => function($data) { 
                    // '<a href='.Url::to('@web/img/products/1500/'.$model->image).'data-toggle="lightbox" class="product_image_btn">'.
                        if ($data->image) {    
                            return '<div class="prod_img_button"><a href="'.Url::to('@web/images/products/1500/'.$data->image).'" class="product_image_btn lightbox">'.
                            Html::img('@web/images/products/266/'.$data->image.'', ['alt' => $data->name, 'class' => 'product_image img-fluid']).
                            '<i class="fa fa-search-plus" aria-hidden="true"></i></a></div>';
                            
                        } else {
                          return Html::img('@web/images/products/266/no-image.jpg', ['alt' => $data->name, 'class' => 'product_image img-fluid']);
                        }
                    // .'<i class="fa fa-search-plus" aria-hidden="true"></i>
                    // </a>',
                    },
                'format'=>'html',
            ],        
            // 'id',
            'name',
            'description',
            // 'image',
            'price',         
            'weight',
            'meta_key',
            // 'order',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name ? $model->category->name: 'Без категории'
            ],
            // [
            //     'attribute' => 'parent_id',
            //     'value' => $model->parentProduct->name ? $model->parentProduct->name: 'Нет родителя'
            // ],            
            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ],  
            [
                'attribute'=>'popular',
                'value' => checkPublic($model->popular),
            ],
            [
                'attribute'=>'child',
                'value' => checkPublic($model->child),
            ],
            [
                'attribute' => 'ingredients',
                'value' => function($model) {
                    $ing = '';
                    foreach ($model->ingredients as $ingredient) {
                        # code...
                        $ing .= '<div class="view_ingredient">'. $ingredient['name']. '</div>';
                    }
                    return $ing;
                },
                'format' => 'html',
            ],               
        ],
    ]) ?>
    <?php if ($model->daughterProducts) { ?>

    <h2>Виды блюда</h2>
    <div class="container" style="padding-left:0">
    <?php 
        foreach ($model->daughterProducts as $daughter) { ?>
            <div class="daughter col-xs-12 col-sm-3 col-md-3">
                <h3><?=$daughter->name?></h3>
                <p>Цена: <?=$daughter->price?> руб.</p>
                <p>Вес: <?=$daughter->weight?></p>
                <?php $ing = '';
                    foreach ($daughter->ingredients as $ingredient) {
                         // debug($daughter);
                        $ing .= '<span>'. $ingredient['name']. ' | </span>';
                    }
                    echo $ing.'<br><br>';
                 ?>                
                <?php // echo Html::a('Редактировать', ['update', 'id' => $daughter->id], ['class' => 'btn btn-default change_daughter', 'target'=>'_blank']) ?>
                <!-- <a href="" class="btn btn-default">Редактировать</div> -->
            </div>
    <?php } ?>
    </div>
    <?php } ?>
    

</div>
