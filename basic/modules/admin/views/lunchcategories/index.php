<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\LunchCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обеденные категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lunch-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
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
                ],                   
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
                    else {
                        return '<span class="text-danger">Не опубликовано</span>';
                    } 
                },   
                'format' => 'html'                 
            ],            
            // 'description',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'order',
                'editableOptions' => [
                    'placement' => 'bottom',
                ],                   
                // 'width' => '50px'
            ], 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php // Pjax::end(); ?></div>
