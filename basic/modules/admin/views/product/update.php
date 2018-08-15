<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
if ($model->parent_id>0) {
$this->title = 'Редактирование вида блюда';
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parentProduct->name, 'url' => ['view', 'id' => $model->parent_id]];
$this->params['breadcrumbs'][] = 'Редактирование вида: '. $model->name;
} else {
$this->title = 'Редактирование блюда';
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
}

?>

<div class="product-update">
	<?php if ($model->parent_id>0) { ?>
    <h1>Редактировать вид: <?= $model->name ?></h1>
    <?php } else { ?>
    <h1>Редактировать блюдо: <?= $model->name ?></h1>
    <?php } ?>
    <?= $this->render('_form', [         
	    'model' => $model,
	    'ingredients' => $ingredients,
    ]) ?>
</div>
