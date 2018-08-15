<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use \app\models\Categories;
use yii\helpers\ArrayHelper;

// use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">
    <h1>Категории</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php // Pjax::begin(); ?>  
<?php 
echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'pjax' => true, 
    'columns' => $gridColumns,
    'responsive'=>false,
    'hover'=>true,
    'columns'=> [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'name',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]                  
                // 'width' => '100px'
            ],             
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'public',
                'pageSummary'=>'Total',
                    'editableOptions'=> [
                      'header' => ' ',
                      'placement' => 'bottom',
                      'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                      'data'=> ['Не опубликовано', 'Опубликовано'],
                    ],
                'filter' => Html::activeDropDownList($searchModel, 'public', ['Нет', 'Да'],['class'=>'form-control','prompt' => ' ']),
                'value' => function($data) {
                    if($data->public==1) {
                        return '<span style="color:green;">Опубликовано</span>';
                    }
                    elseif($data->public===0) {
                        return '<span class="text-danger">Не опубликовано</span>';
                    } 
                    else {
                        return '<span>Не задано</span>';

                    }
                },   
                'format' => 'html'                 
            ],    

            [
                'attribute'=>'parent_id',
                'filter' => Html::activeDropDownList($searchModel, 'parent_id', ArrayHelper::map(Categories::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => ' ']),
                // 'content'=>function($data){
                    // return $data->category->name;
                // }
                'value' => function($data) {
                    return $data->category->name ? $data->category->name: 'Нет родителя';
                },                
            ],             
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'order_num',
                'width' => '100px',
                    'editableOptions' => [
                        'placement' => 'bottom',
                    ]                  
            ],             
            ['class' => 'yii\grid\ActionColumn'],


    ]
]);  

?>

<?php // Pjax::end(); ?></div>
