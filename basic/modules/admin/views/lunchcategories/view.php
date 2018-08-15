<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\LunchCategories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обеденные категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lunch-categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'order',
            // 'description',
            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ],  
        ],
    ]) ?>

</div>
