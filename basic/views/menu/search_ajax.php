<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="search_page search_page_ajax">
	<div class="col-xs-12 products_list">
		<?php if( !empty($cats)||!empty($products) ): ?>
			<?php if( !empty($cats)) { ?>
				<div class="page_header">
					<div class="h3">Найденные категории по запросу: "<?= Html::encode($q); ?>"</div>
				</div>
				<div class="cat_nav">
					<ul class="catalog nav nav-pills">
						<?php foreach ($cats as $cat): ?>
							<li>
								<?php if (($cat->class)=='index') { ?>
									<a href="<?= Url::to(['menu/index']) ?>">
								<?php } elseif (($cat->class)=='child')  {?>
									<a href="<?= Url::to(['menu/child']) ?>">
								<?php } else { ?>
									<a href="<?= Url::to(['menu/view', 'id'=> $cat->id]) ?>">
								<?php } ?>
									<?= $cat->name; ?>
									</a>
							</li>			
						<?php endforeach;?>
					</ul>
				</div>
			<?php } ?>
			<?php if( !empty($products)): ?>
				<?php if (count($products)==1) { ?>
					<?php foreach ($products as $product) { ?>
						<div class=" product">
		  			 		<?php if(!Yii::$app->user->isGuest) { ?>
								<a href="<?= \yii\helpers\Url::to(['admin/product/update', 'id'=>$product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
									<span class="plus_cat">
										<i class="fa fa-pencil"></i>
									</span>
								</a>		    	
							<?php } ?>								
							<div class="product_details">
								<h3><?= $product->name?></h3>
								<p><?= $product->description?></p>
							</div>
							<div class="product_details">
								<div class="product_image_block col-xs-12 col-sm-6">
									<a href="<?= Url::to('@web/images/products/1500/'.$product->image.'')?>" class="product_image_btn" data-toggle="lightbox">
										<?= Html::img("@web/images/products/600/{$product->image}", ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
										<i class="fa fa-search-plus" aria-hidden="true"></i>
									</a>
								</div>
								<?php if (!empty($product->consist)) { ?>
								<div class="consistance col-xs-12 col-sm-5 col-sm-offset-1">
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
								<?php if (!empty($product->price)&&!empty($product->weight)) { ?>				
									<div class="details">
										<?php if (!empty($product->price)): ?>
										<span class=""><?= $product->price?> <span class="rub">Р</span></span>
										<?php endif ?>
										<?php if (!empty($product->price)&&(!empty($product->weight))): ?>
										<div class="vert_line"></div>
										<?php endif ?>
										<?php if (!empty($product->weight)): ?>
										<span><?= $product->weight?></span>
										<?php endif ?>
									</div>
								<?php } ?>
								<div class="clearfix"></div>
								<?php if (!empty($session['wishlist'][$product->id])){ ?>
								<a href="<?= Url::to(['wishlist/delete', 'id'=>$product->id]) ?>" class="btn btn-primary added" data-id="<?= $product->id?>" role="button">
									<i class="fa fa-check" aria-hidden="true"></i>
								</a>
								<?php } else {?>
								<a href="<?= Url::to(['wishlist/add', 'id'=>$product->id]) ?>" class="btn btn-primary add_to_cart" data-id="<?= $product->id?>" role="button">Запомнить
									<i class="fa fa-heart-o" aria-hidden="true"></i>
								</a>
								<?php } ?>				
							</div>
						</div>
					<?php } ?>

				<?php } else { ?>
				<div class="page_header">
					<span class="h2">Найденные блюда по запросу: "<?= Html::encode($q); ?>"</span>
				</div>
					<?php foreach ($products as $product): ?>	
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 product_block">
							<div class="thumbnail">
		  			 		<?php if(!Yii::$app->user->isGuest) { ?>
								<a href="<?= \yii\helpers\Url::to(['admin/product/update', 'id'=>$product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
									<span class="plus_cat">
										<i class="fa fa-pencil"></i>
									</span>
								</a>		    	
							<?php } ?>									
									<?php if (($product->id)==($product->subProducts[0]->parent_id)) { ?>
								<div class="assort" data-ajaxAssort="<?= $product->id ?>">
									<div class="close_assort" class="close">✕</div>
									<div class="h3">Виды блюда: <?= $product->name ?></div>
									<hr>
									<div class="carousel">
										<div class="owl-carousel owl-theme">
										<?php foreach ($product->subProducts as $sub_product): ?>
										<?php if (($product->id)==($sub_product->parent_id)) {?>
											<div class="assort_item item">
												<div class="assort_wrap">
		  			 		<?php if(!Yii::$app->user->isGuest) { ?>
								<a href="<?= \yii\helpers\Url::to(['admin/product/update', 'id'=>$sub_product->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
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
													<div class="list_price">-</span></div>
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
									<?= Html::img("@web/images/products/266/{$product->image}", ['alt' => $product->name, 'class' => 'product_image img-fluid']) ?>
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
											<div class="list_price">-</span></div>
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
									<?php if (($product->id)==($product->subProducts[0]->parent_id)) { ?>
										<div class="prod_list_item_buttons sub">
									<? } else { ?>
										<div class="prod_list_item_buttons">
									<? } ?>
										<a href="<?= Url::to(['product/view', 'id'=>$product->id]) ?>" class="btn btn-default" role="button">Подробнее</a>
										<?php if (!empty($session['wishlist'][$product->id])){ ?>
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
					<?php endforeach;?>




				<?php } ?>
			<?php endif; ?>
		<?php else: ?>
			<div class="page_header">
				<span class="h4">По данному запросу ничего не найдено</span>
			</div>
		 <?php endif; ?>
	</div>
	<div class="search_ajax_header"></div>
</div>