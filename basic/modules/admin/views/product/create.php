<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = 'Создание блюда';
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
	<?php if ($parent>0) { ?>
    <h1>Создать вид для <?= $parent_product->name ?></h1>
    <?php } else { ?>
    <h1>Создать блюдо</h1>
	<?php } ?>
    <?= $this->render('_form', [
        'model' => $model,
    	'ingredients' => $ingredients,
    	'parent' => $parent,
    ]) ?>

</div>
