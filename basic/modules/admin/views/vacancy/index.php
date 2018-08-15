<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вакансии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать вакансию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive'=>false,

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
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'short_description',
                'editableOptions' => [
                       'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                       'placement' => 'bottom',
                        // 'asPopover' => false,
                       // 'size' => 'md',
                    ]
                // 'width' => '100px',
                // 'rows' => '4',
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
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'salary',
                'editableOptions' => [
                    'placement' => 'bottom',
                ]                
                // 'width' => '100px',
            ],            
            'date',
            // 'description',
            // 'meta_title',
            // 'meta_key',
            // 'meta_desc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
