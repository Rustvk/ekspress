<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Company */

$this->title = 'Редактирование объявления';
$this->params['breadcrumbs'][] = ['label' => 'Объявление', 'url' => ['index', 'id' => $model->advert_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
