<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use \app\models\Categories;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1>Список блюд</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать блюдо', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute' => 'name',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]                      
                    // 'width' => '100px',
                ],
                // 'description',
                // 'ingredients',
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute'=>'public',
                    'pageSummary'=>'Total',
                        'editableOptions'=> [
                          'placement' => 'bottom',
                          'header' => ' ',
                          'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                          'data'=> ['Не опубликовано', 'Опубликовано'],
                        ],
                    'filter' => Html::activeDropDownList($searchModel, 'public', ['Нет', 'Да'],['class'=>'form-control','prompt' => ' ']),
                    'value' => function($data) {
                        if($data->public==1) {
                            return '<span style="color:green;">Опубликовано</span>';
                        }
                        else {
                            return '<span class="text-danger">Не опубликовано</span>';
                        } 
                    },   
                    'format' => 'html'                 
                ],
                [
                    'attribute'=>'category_id',
                    'filter' => Html::activeDropDownList($searchModel, 'category_id', ArrayHelper::map(Categories::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => ' ']),
                    'content'=>function($data){
                        return $data->category->name;
                    }
                ], 
                
                // 'image',
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute' => 'price',
                    'width' => '100px',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]   
                ],
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute' => 'weight',
                    'width' => '100px',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]   
                ],                
                // 'weight',
                // 'popular',
                // 'meta_key',
                // 'order',
                [
                    'class'=>'kartik\grid\EditableColumn',
                    'attribute' => 'order',
                    'width' => '100px',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]   
                ],                           
                // [
                //     'attribute' => 'category_id',
                //     'value' => function($data) {
                //         if ($data->category->name) {
                //             return $data->category->name;
                //         }
                //         else { 
                //             return 'Нет категорий';
                //         }
                //     }
                // ],
                // [
                //     'attribute' => 'parent_id',
                //     'filter' => '',
                //     'value' => function($data) {
                //         if ($data->parentProduct->name) {
                //             return $data->parentProduct->name;
                //         }
                //         else { 
                //             return 'Нет';
                //         }
                //     }
                // ],
                // 'child',

                ['class' => 'yii\grid\ActionColumn'
                ],
            ],
        ]); ?>
    <?php // Pjax::end(); ?></div>
