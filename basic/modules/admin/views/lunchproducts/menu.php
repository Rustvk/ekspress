<?php

// use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\lunchProducts */

$this->title = 'Обеденное меню';
$this->params['breadcrumbs'][] = ['label' => 'Обеденное меню', 'url' => ['menu']];
?>
<div class="printlunch btn btn-primary">Распечатать</div>

<div class="page">
<div class="lunchmenupage" style="padding: 20px;  box-sizing:border-box; width: 100%; height:297mm; display: block; bottom:0; top:0; 	color:black; position:relative;">
	<!-- <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> -->
	<div class="lunchmenu" style="border:5px solid black; padding: 20px; box-sizing:border-box; font-family: 'ComicSans', cursive; height:100%; ">
		<div class="lunchdate" style="font-size: 12pt; float:left; text-decoration:underline;"><?=date('Y')?>г.</div>
		<div class="lunchagree" style="font-size: 12pt; float:right;">Подтверждаю ___________</div>
		<div class="clearfix"></div>
		<h1 style="font-size:32pt; text-align: center; font-family: cursive; font-weight:normal;">МЕНЮ</h1>	
		<?php
		// debug($cat_products[0]->lunchProducts[0]->public);
		foreach ($lunchs as $category) { ?>
			<h3 style="font-size: 20pt; font-weight: bold; text-align: center; font-family: cursive;"><?= $category->name ?>:</h3>
			<?php
				foreach ($category->lunchProducts as $product) { ?>
					<div class="lunchproduct" style="padding: 0 50px;">
						<span class="name" style="font-size: 16pt;"><?=$product->name?></span>
						<span class="weight" style="font-size: 11pt;"><?=$product->weight?></span>
						<span class="price" style="font-size: 16pt; float:right; font-weight: bold;">- <?=$product->price?> руб.</span>
					</div>
				<?php }
			?>
		<?php } ?>
	</div>
</div>
</div>