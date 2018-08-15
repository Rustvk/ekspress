<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

	<div class="category_header">
		<div class="img_cat_back">
			<?= Html::img("@web/images/lunchcategories/back_image.jpg", ['alt' => 'Обеденное меню Кафе "Экспресс"']) ?>
			<div class="color_cat_img_cover"></div>
		</div>
		<div class="category_text_header">
			<ol class="breadcrumb">
			  <li><a href="<?= Url::Home() ?>">Главная</a></li>
			  <li class="active">Обеденное меню</li>
			</ol>
			<div class="pageheaderleft">
				<!-- <h1>Обеденное меню</h1> -->
				<h1>Сегодня в нашем меню</h1>
				<span>Позиции данного меню вы можете заказать в нашем заведении</span>
			</div>
		</div>
	</div>
	<div class="container lunch">
		<div class="col-xs-12 col-md-3 col-lg-2 cat_nav">
			<div>
				<div class="show_cats_button">Показать категории</div>
				<div class="nav_menu">
					<div class="close_nav">✕</div>
					<h2>Категории</h2>
					<ul class="catalog nav nav-pills" id="cd-vertical-nav">
						<?php foreach ($categories as $category) { ?>
			  			  <?php if(!Yii::$app->user->isGuest) { ?>
								<a href="<?= \yii\helpers\URL::to(['admin/lunchcategories/update', 'id'=>$category->id]) ?>" class="pull-right" style="position:absolute; left:0px;" target="_blank">
									<span class="plus_cat">
										<i class="fa fa-pencil"></i>
									</span>
								</a>		    	
							<?php } ?>							
							<li>
								<a href="<?= Url::to(['lunch/index', '#'=>$category->id]) ?>"><?=$category->name ?></a>
							</li>
						<?php } ?>
					</ul>	
				</div>
			</div>
		</div>	
		<div class="col-xs-12 col-sm-12 col-md-8  col-md-offset-1 col-lg-9 products_list" >
		<?php foreach ($cat_products as $products): ?>
			<div class="lunch_header" id="<?=$products->id?>"><span><?=$products->name?></span></div>
			<?php foreach ($products->lunchProducts as $product): ?>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 product_block">
				<div class="thumbnail">
					<div class="prod_img_button">
						<!-- <a href="<?php // echo Url::to('@web/img/products/1500/'.$product->image.'')?>" class="product_image_btn" data-toggle="lightbox"> -->
							<?= Html::img("@web/images/lunchproducts/266/{$product->image}", ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
							<!-- <i class="fa fa-search-plus" aria-hidden="true"></i> -->
						<!-- </a> -->
					</div>
					<div class="caption">
						<div class="prod_list_item_info">
							<h4><?= $product->name?></h4>
				  			 	<?php if(!Yii::$app->user->isGuest) { ?>
									<a href="<?= \yii\helpers\URL::to(['admin/lunchproducts/update', 'id'=>$product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
										<span class="plus_cat">
											<i class="fa fa-pencil"></i>
										</span>
									</a>		    	
								<?php } ?>								
								<?php if (!empty($product->price)) { ?><div class="list_price"><?= $product->price?> <span class="rub">Р</span></div>
								<?php }							
								else  { ?>
								<div class="list_price">-</span></div>
								<?php }  ?>
								<!-- <p><? // $product->description?></p> -->
						</div>
					</div>							
				</div>
			</div>				
		<?php endforeach; ?>
			<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>
		<?php endforeach; ?>
	</div>
	</div>	