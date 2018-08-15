<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Company */

$this->title = 'Редактирование данных: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index', 'id' => $model->company_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
