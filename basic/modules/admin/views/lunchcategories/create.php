<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\LunchCategories */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Обеденные категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lunch-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
