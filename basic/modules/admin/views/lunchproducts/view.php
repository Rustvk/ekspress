<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\lunchProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обеденные блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lunch-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            // 'id',
            [
            'attribute'=>'image',
            'value' => function($data) { 
                // '<a href='.Url::to('@web/img/products/1500/'.$model->image).'data-toggle="lightbox" class="product_image_btn">'.
                    if ($data->image) { 
                        return Html::img('@web/images/lunchproducts/266/'.$data->image.'', ['alt' => $data->name, 'class' => 'product_image img-fluid']);
                    } else {
                      return Html::img('@web/images/lunchproducts/266/no-image.jpg', ['alt' => $data->name, 'class' => 'product_image img-fluid']);
                    }
                // .'<i class="fa fa-search-plus" aria-hidden="true"></i>
                // </a>',
                },
            'format'=>'html',
            ],        
            'name',
            'price',
            'weight',            
            // 'description',
            [
                'attribute' => 'lunch_category_id',
                'value' => $model->lunchCategory->name ? $model->lunchCategory->name: 'Без категории'
            ],                  
            'order',
            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ],  
        ],
    ]) ?>

</div>
