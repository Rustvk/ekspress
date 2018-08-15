<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
        // 'pjax' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'created_at',
                'filter' => '',          
            ],
            // [
            //     'class'=>'kartik\grid\EditableColumn',
            //     'attribute'=>'created_at',
            //     'pageSummary'=>'Total',
            //         'editableOptions'=> [
            //           'header' => ' ',
            //           'inputType' => \kartik\editable\Editable::INPUT_DATE,
            //         ],
            //     'filter' => Html::activeDropDownList($searchModel, 'new', ['Просмотреные', 'Новые'],['class'=>'form-control','prompt' => ' ']),
            //     'format' => 'html'                 
            // ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'name',
                'editableOptions' => [
                    'placement' => 'bottom',
                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                ]                
            ],
            'phone',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'new',
                'pageSummary'=>'Total',
                    'editableOptions'=> [
                      'header' => ' ',
                      'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                      'data'=> ['Просмотрен', 'Новый'],
                      'placement' => 'bottom',
                    ],
                'filter' => Html::activeDropDownList($searchModel, 'new', ['Просмотреные', 'Новые'],['class'=>'form-control','prompt' => ' ']),
                'value' => function($data) {
                    if($data->new==1) {
                        return 'Новый';

                    }
                    else {
                        return '<span style="color:green;">Просмотрен</span>';

                    } 
                },   
                'format' => 'html'                 
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'status',
                'pageSummary'=>'Total',
                    'editableOptions'=> [
                      'header' => ' ',
                      'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                      'data'=> ['Активен', 'Завершен'],
                      'placement' => 'bottom',                   

                    ],
                'filter' => Html::activeDropDownList($searchModel, 'new', ['Активен', 'Завершен'],['class'=>'form-control','prompt' => ' ']),
                'value' => function($data) {
                    if($data->status==0) {
                        return 'Активен';

                    }
                    elseif ($data->status==1) {
                        return '<span style="color:green;">Завершен</span>';

                    } 
                },   
                'format' => 'html'                 
            ],            
            // [
            //     'class'=>'kartik\grid\EditableColumn',
            //     'attribute'=>'type',
            //     'pageSummary'=>'Total',
            //         'editableOptions'=> [
            //           'header' => ' ',
            //           'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
            //           'data'=> ['Банкет', 'Заказ на вынос', 'Обед'],
            //         ],
            //     'filter' => Html::activeDropDownList($searchModel, 'type', ['Банкет', 'Заказ на вынос', 'Обед'],['class'=>'form-control','prompt' => ' ']),
            //     // 'value' => function($data) {
            //     //     if($data->new==1) {
            //     //         return '<span class="text-danger">Новый</span>';
            //     //     }
            //     //     else {
            //     //         return '<span style="color:green;">Просмотрен</span>';

            //     //     } 
            //     // },   
            //     'format' => 'html'                 
            // ],
            // 'type',           
            // 'email:email',
            // 'message',
            // 'qty',
            // 'summ',
            [
                'attribute' => 'to_date',
                'filter' => '',
            ],
            ['class' => 'yii\grid\ActionColumn',
             'headerOptions' => ['style' => 'width:80px'],
            ],
        ],
    ]); ?>
