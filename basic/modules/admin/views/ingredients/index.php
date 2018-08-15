<?php

use yii\helpers\Html;
use kartik\grid\GridView;
// use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\IngredientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать ингредиент', ['create'], ['class' => 'btn btn-success']) ?>
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
                    ]   
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
