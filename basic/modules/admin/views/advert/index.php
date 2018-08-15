<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Company */

$this->title = 'Объявление';
// $this->params['breadcrumbs'][] = ['label' => 'Кафе "Экспресс"', 'url' => ['index', 'id'=>1]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->advert_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'company_id',
            [
                'attribute' => 'text',
                'format' => 'html'
            ],            
            [
                'attribute'=>'public',
                'value' => checkPublic($model->public),
            ], 

            // 'public',
            // 'image',
            // 'logo',
        ],
    ]) ?>

</div>
