<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use \app\models\LunchCategories;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\lunchProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обеденные блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lunch-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать блюдо', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                ],                
            ], 
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
                'attribute'=>'lunch_category_id',
                'filter' => Html::activeDropDownList($searchModel, 'lunch_category_id', ArrayHelper::map(LunchCategories::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => ' ']),
                'content'=>function($data){
                    return $data->lunchCategory->name;
                }
            ], 
            // 'description',
            // 'image',
            // 'lunch_category_id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'price',
                'width' => '100px',
                'editableOptions' => [
                    'placement' => 'bottom',
                ],                
            ],  
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'weight',
                'width' => '100px',
                'editableOptions' => [
                    'placement' => 'bottom',
                ],                
            ],     
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'order',
                'width' => '100px',
                'editableOptions' => [
                    'placement' => 'bottom',
                ],                
            ], 
            // 'order',
            // 'public',
            // 'price',
            // 'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
