<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use app\assets\ProductAsset;
// ProductAsset::register($this);
?>

	<div class="container product" id="section1">
		<ol class="breadcrumb">
		  <li><a href="<?= Url::Home()?>">Главная</a></li>
		  <li><a href="<?= Url::to(['menu/'])?>">Меню</a></li>
		  <li><a href="<?= Url::to(['menu/view','id'=>$product->category->id])?>"><?= $product->category->name ?></a></li>
		  <li class="active"><?= $product->name ?></li>
		</ol>
		<div class="col-xs-12 col-sm-5 product_image_block">
				<a href="<?= Url::to('@web/images/products/1500/'.$product->image.'')?>" class="product_image_btn" data-toggle="lightbox">
					<?= Html::img("@web/images/products/600/{$product->image}", ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
					<i class="fa fa-search-plus" aria-hidden="true"></i>
				</a>
		</div>
		<div class="col-xs-12 col-sm-6 product_details">
	  			 	<?php if(!Yii::$app->user->isGuest) { ?>
						<a href="<?= \yii\helpers\URL::to(['admin/product/update', 'id'=>$product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
							<span class="plus_cat">
								<i class="fa fa-pencil"></i>
							</span>
						</a>		    	
					<?php } ?>			
			<h1><?= $product->name?></h1>
			<p><?= $product->description?></p>
				<?php if (empty($sub_product)) {?>
					<?php if (!empty($product->price)||!empty($product->weight)) { ?>
						<div class="details">
							<?php if (!empty($product->price)){ ?>
								<span class=""><?= $product->price?> <span class="rub">Р</span></span>
							<?php } ?>
							<?php if (!empty($product->price)&&(!empty($product->weight))){ ?>
								<div class="vert_line"></div>
							<?php } ?>
							<?php if (!empty($product->weight)){ ?>
								<span><?= $product->weight?></span>
							<?php } ?>
						</div>
					<?php } ?>
					<div class="clearfix"></div>
					<?php if (!empty($product->consist)) { ?>
					<div class="consistance">
						<span>Состав:</span>
						<ul>
							<?php foreach ($product->consist as $ingredient) { ?>
								<li>
									<?= $ingredient->name ?>
								</li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
				<?php if (!empty($session['wishlist'][$product->id])){ ?>
				<a href="<?= Url::to(['wishlist/delete', 'id'=>$product->id]) ?>" class="btn btn-primary added" data-id="<?= $product->id?>" role="button">
					<i class="fa fa-check" aria-hidden="true"></i>
				</a>
				<?php } else {?>
				<a href="<?= Url::to(['wishlist/add', 'id'=>$product->id]) ?>" class="btn btn-primary add_to_cart" data-id="<?= $product->id?>" role="button">Запомнить
					<i class="fa fa-heart-o" aria-hidden="true"></i>
				</a>
				<?php } ?>	
			<?php } else { ?>
				<div class="stick">
					Данное блюдо имеет несколько видов в своём ассортименте. Вы можете ознакомиться с ними ниже.
				</div>
				<div id="cd-vertical-nav">
		            <a href="#section2" class="down" data-number="2">
					<div class="btn btn-primary kinds_down" role="button">Виды
						<i class="fa fa-angle-down" aria-hidden="true"></i>
			        </div>
		            </a>
		        </div>
			<?php } ?>
				
		</div>
		<?php if( !empty($sub_product) ): ?>
		<div class="col-xs-12">
				<div class="page_header cd-section" id="section2">
					<span class="h3">Виды данного блюда:</span>
				</div>
				
			<?php foreach ($sub_product as $prod): ?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 product_block sub_product">
				<div class="thumbnail">
					<div>
						<div>
	  			 	<?php if(!Yii::$app->user->isGuest) { ?>
						<a href="<?= \yii\helpers\URL::to(['admin/product/update', 'id'=>$prod->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
							<span class="plus_cat">
								<i class="fa fa-pencil"></i>
							</span>
						</a>		    	
					<?php } ?>								
							<h4><?= $prod->name?></h4>		
							<?php if (!empty($prod->price)) { ?><div class="list_price"><?= $prod->price?> <span class="rub">Р</span></div>
							<?php }
							else  { ?>
							<div class="list_price">-</span></div>
							<?php }  ?>
						</div>
						<?php if (!empty($prod->weight)) { ?>
								<?php if (!empty($prod->weight)){ ?>
									<span><?= $prod->weight?></span>
								<?php } ?>
						<?php } ?>	
						<?php if (!empty($prod->consist)) { ?>
						<div class="subconsistance">
							<ul>
								<?php foreach ($prod->consist as $ingredient) { ?>
									<li>
										<?= $ingredient->name ?>
									</li>
								<?php } ?>
							</ul>
						</div>
						<?php } ?>										
						<div class="prod_list_item_buttons">
							<?php if (!empty($session['wishlist'][$prod->id])){ ?>
							<a href="<?= Url::to(['wishlist/delete', 'id'=>$prod->id]) ?>" class="btn btn-primary added" data-id="<?= $prod->id?>" role="button">
								<i class="fa fa-check" aria-hidden="true"></i>
							</a>
							<?php } else {?>
							<a href="<?= Url::to(['wishlist/add', 'id'=>$prod->id]) ?>" class="btn btn-primary add_to_cart" data-id="<?= $prod->id?>" role="button">Запомнить
								<i class="fa fa-heart-o" aria-hidden="true"></i>
							</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>				
			<?php endforeach;?>
		<?php endif; ?>
	</div>
	</div>
