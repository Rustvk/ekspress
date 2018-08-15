<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\SimplePages */

$this->title = 'Создать простую страницу';
$this->params['breadcrumbs'][] = ['label' => 'Простая страница', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simple-pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
