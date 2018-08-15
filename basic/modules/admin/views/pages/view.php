<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SimplePages */

$this->title = $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Simple Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simple-pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную страницу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            // [
            //     'attribute' => 'content',
            //     'format' => 'text',
                // 'value'=>$model->fotodir,
                // 'contentOptions'=>['style'=>'max-width: 300px; position:relative']
            // ],
            'meta_key',
            'meta_title',
            'meta_description',
            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ],  

        ],
    ]) ?>

</div>
