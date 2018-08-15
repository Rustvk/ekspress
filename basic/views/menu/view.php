<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
?>	
	<div class="category_header" id="list">
		<div class="img_cat_back">
			<?php if($category->back_image) { ?>
			<?= Html::img("@web/images/categories/1500/{$category->back_image}", ['alt' => $category->name]) ?>
			<?php } else { ?>
			<?= Html::img("@web/images/categories/1500/back_image.jpg", ['alt' => $category->name]) ?>
			<?php } ?>
			<div class="color_cat_img_cover"></div>
		</div>
		<div class="category_text_header">
			<ol class="breadcrumb">
			  <li><a href="<?= Url::Home() ?>">Главная</a></li>
			  <?php 
			 	if (($category->class)=='index') { ?>
			 		<li class="active">Меню</li> 
				<?php }

				else { ?>
			  <li><a href="<?= Url::to(['menu/index']) ?>">Меню</a></li>
			  <li class="active"><?= $category->name?></li>
			  	<?php } ?>
			</ol>
			<div class="pageheaderleft">
			 	<?php if (($category->class)=='index') { ?>
					<h1>Банкетное меню</h1>
				<?php } else { ?>
					<h1><?= $category->name?></h1>
				<?php } ?>
				<?php if ($category->description): ?>
					<span><?= $category->description?></span>
				<!-- <hr> -->
				<?php endif ?>					
			</div>
		</div>
	</div>
	<div class="container">
		<div class="col-xs-12 col-md-3 col-lg-2 cat_nav">
			<div>
				<div class="show_cats_button">Показать категории</div>
				<div class="nav_menu">
					<div class="close_nav">✕</div>
					<h2>Категории</h2>
					<ul class="catalog nav nav-pills">
						<li
						 <?php 
						 	if (($category->class)=='index') { ?>
						 	class="active" 
							<?php }
						 ?>
						>
							<a href="<?= Url::to(['menu/index', '#'=>'list']) ?>">Популярные блюда</a>
						</li>
						<?= app\components\CategoryMenuWidget::widget(['tpl'=>'cat_menu', 'active'=>$category->id]); ?>
						<li
						 <?php 
						 	if (($category->class)=='child') { ?>
						 	class="active" 
							<?php }
						 ?>
						>
							<a href="<?= Url::to(['menu/child', '#'=>'list']) ?>">Детское меню</a>
						</li>						
					</ul>	
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8  col-md-offset-1 col-lg-9 products_list" id="page_assort">
			<?php if( !empty($products) ): ?>
				<div class="col-xs-12 product_list_header">
					<div class="col-xs-6">
						Показано 
						<?php echo(($pages->getPageSize()*($pages->getPage()))+1); // Получаем стартовые норма записей?> 
						-
						<?php 
						if (($pages->getPageSize())*($pages->getPage()+1)<($pages->totalCount)) {
						echo(($pages->getPageSize())*($pages->getPage()+1)); // Получаем конечные номера 
						} 
						else {
						 echo $pages->totalCount; // Общее количество записей
						}
						
						?>
						из 
						<?php echo $pages->totalCount; // Общее количество записей ?> 
						записей
					</div>
					<div class="col-xs-5 col-xs-offset-1 pull-right">
						<div class="pull-right col-xs-12 view_icons">
							<?php
								if ($category->id==7) {
									$cat_link='';
								}
								else {
									$cat_link = $category->id.'/';
								}
							?>
							<a href="<?= Url::to(['menu/'.$cat_link.'size=9'])?>" class="circle<?php if ($pages->getPageSize()==9): ?> active_circle<?php endif?>">9</a>
							<a href="<?= Url::to(['menu/'.$cat_link.'size=18'])?>" class="circle<?php if ($pages->getPageSize()==18): ?> active_circle<?php endif?>">18</a>
							<a href="<?= Url::to(['menu/'.$cat_link.'size=27'])?>" class="circle<?php if ($pages->getPageSize()==27): ?> active_circle<?php endif?>">27</a>						
						</div>
					</div>
				</div>
			<?php foreach ($products as $product): ?>
			<div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 product_block">
				<div class="thumbnail">
	  			 	<?php if(!Yii::$app->user->isGuest) { ?>
						<a href="<?= \yii\helpers\URL::to(['admin/product/update', 'id'=>$product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
							<span class="plus_cat">
								<i class="fa fa-pencil"></i>
							</span>
						</a>		    	
					<?php } ?>					
					<?php if (($product->id)==($product->subProducts[0]->parent_id)) { ?>
					<div class="assort" data-assort="<?= $product->id ?>">
						<div class="close_assort close">✕</div>
						<div class="h3">Виды блюда: <?= $product->name ?></div>
						<hr>
						<div class="carousel">
							<div class="owl-carousel owl-theme">
							<?php foreach ($product->subProducts as $sub_product): ?>
							<?php if (($product->id)==($sub_product->parent_id)) {?>
								<div class="assort_item item">
									<div class="assort_wrap">
					  			 		<?php if(!Yii::$app->user->isGuest) { ?>
											<a href="<?= \yii\helpers\URL::to(['admin/product/update', 'id'=>$sub_product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
												<span class="plus_cat">
													<i class="fa fa-pencil"></i>
												</span>
											</a>		    	
										<?php } ?>										
										<div class="h4"><?=$sub_product->name?></div>
										<div class="p"><?=$sub_product->description?></div>
										<?php if (!empty($sub_product->price)) { ?><div class="list_price"><?= $sub_product->price?> <span class="rub">Р</span></div>
										<?php }
										else  { ?>
										<div class="list_price">-</div>
										<?php } ?>
										<div class="prod_list_item_buttons">
											<a href="<?= Url::to(['product/view', 'id'=>$product->id, '#'=>'section1']) ?>" class="btn btn-default" role="button">Подробнее</a>
											<?php if (!empty($session['wishlist'][$sub_product->id])){ ?>
											<a href="<?= Url::to(['wishlist/delete', 'id'=>$sub_product->id]) ?>" class="btn btn-primary added" data-id="<?= $sub_product->id?>" role="button">
												<i class="fa fa-check" aria-hidden="true"></i>
											</a>
											<?php } else {?>
											<a href="<?= Url::to(['wishlist/add', 'id'=>$sub_product->id]) ?>" class="btn btn-primary add_to_cart" data-id="<?= $sub_product->id?>" role="button">Запомнить
												<i class="fa fa-heart-o" aria-hidden="true"></i>
											</a>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>
							<?php endforeach ?>
							</div>
						</div>
					</div>
					<?php } ?>					
					<div class="prod_img_button">
						<a href="<?php echo Url::to('@web/images/products/1500/'.$product->image.'')?>" class="product_image_btn" data-toggle="lightbox">
							<?= Html::img("@web/images/products/266/{$product->image}", ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
							<i class="fa fa-search-plus" aria-hidden="true"></i>
						</a>
					</div>
					<div class="caption">
						<div class="prod_list_item_info">
							<h4><?= $product->name?></h4>
							<?php if (($product->id)==($product->subProducts[0]->parent_id)){ ?>
								<div class="stick">
								Блюдо имеет несколько видов.
								</div>
							<?php } else {?>	
								<?php if (!empty($product->price)) { ?><div class="list_price"><?= $product->price?> <span class="rub">Р</span></div>
								<?php }							
								else  { ?>
								<div class="list_price">-</div>
								<?php }  ?>
							<?php }?>							
							<?php if (strlen($product->description)>65) { ?>
								<p class="length">
									<?= $product->description?>
								</p>
								<span class="dots">...</span>
							<?php } else {?>							
								<p><?= $product->description?></p>
							<?php }?>							
						</div>
						<div class="prod_list_item_buttons">
							<a href="<?= Url::to(['product/view', 'id'=>$product->id]) ?>" class="btn btn-default" role="button">Подробнее</a>
							<?php if (!empty($session['wishlist'][$product->id])) { ?>
								<?php if (($product->id)==($product->subProducts[0]->parent_id)) { ?>
									<div class="btn btn-primary kinds" data-id="<?= $product->id?>" role="button">Виды
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</div>
								<?php } else { ?> 
									<a href="<?= Url::to(['wishlist/delete', 'id'=>$product->id]) ?>" class="btn btn-primary added" data-id="<?= $product->id?>" role="button">
										<i class="fa fa-check" aria-hidden="true"></i>
									</a>
								<?php } ?>
							<?php } else {?>
								<?php if (($product->id)==($product->subProducts[0]->parent_id)) { ?>						
									<div class="btn btn-primary kinds" data-id="<?= $product->id?>" role="button">Виды
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</div>
								<?php } else { ?>
									<a href="<?= Url::to(['wishlist/add', 'id'=>$product->id]) ?>" class="btn btn-primary add_to_cart" data-id="<?= $product->id?>" role="button">Запомнить
										<i class="fa fa-heart-o" aria-hidden="true"></i>
									</a>
								<?php } ?>
							<?php } ?>
						</div>
					</div>							
				</div>
			</div>				
			<?php endforeach; ?>
			<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>

			
			<div class="pagination_block">
				<?php
				echo LinkPager::widget([
				    'pagination' => $pages,
				]);
				?>
			</div>
			<?php else: ?>
				<div class="page_header">
					<span class="h2">К сожалению блюда в данной категории пока что отсутствуют</span>
				</div>
			<?php endif; ?>
		</div>
	</div>


