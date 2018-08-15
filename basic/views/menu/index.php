<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


?>
    
	<div class="category_header">
		<div class="img_cat_back">
			<?= Html::img("@web/images/categories/1500/{$category->back_image}", ['alt' => $category->name]) ?>
			<div class="color_cat_img_cover"></div>
		</div>
		<div class="category_text_header">
			<ol class="breadcrumb">
			  <li><a href="<?= Url::Home()  ?>">Главная</a></li>
			  <li class="active">Меню</li>
			</ol>
			<h1>
				<div class="pageheaderleft">
					<h1><?= $index_popular->name?></h1>
				</div>
			</h1>
		</div>
	</div>
	<div class="container" data-target="#myScrollspy">
		<div class="col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-12 col-md-12 col-lg-2 cat_nav" id="myScrollspy">
			<div id="myNav">
				<h2>Категории</h2>
				<ul class="catalog nav nav-pills">
					<li class="active">
						<a href="<?= Url::to(['menu/index']) ?>">Популярные блюда</a>
					</li>
					<?= app\components\CategoryMenuWidget::widget(['tpl'=>'cat_menu']); ?>
				</ul>	
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 products_list col-lg-offset-1">
			<?php if( !empty($populars) ): ?>
				<?php if ($index_popular->description): ?>
				<div class="page_header">
					<span><?= $index_popular->description?></span>
				</div>
				<?php endif ?>
				<div class="col-xs-12 product_list_header">
					<div class="col-xs-6">
						Показано 
						<?php echo(($pages->getPageSize()*($pages->getPage()))+1); // Получаем стартовые норма записей?> 
						-
						<?php echo(($pages->getPageSize())*($pages->getPage()+1)); // Получаем конечные номера ?> 
						из 
						<?php echo $pages->totalCount; // Общее количество записей ?> 
						записей
					</div>
					<div class="col-xs-5 col-xs-offset-1 pull-right">
						<div class="pull-right col-xs-12 view_icons">
							<a href="<?= Url::to(['menu/size=9'])?>" class="circle<?php if ($pages->getPageSize()==9): ?> active_circle<?php endif?>">9</a>
							<a href="<?= Url::to(['menu/size=18'])?>" class="circle<?php if ($pages->getPageSize()==18): ?> active_circle<?php endif?>">18</a>
							<a href="<?= Url::to(['menu/size=27'])?>" class="circle<?php if ($pages->getPageSize()==27): ?> active_circle<?php endif?>">27</a>						
						</div>
					</div>
				</div>
			<?php foreach ($populars as $popular): ?>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 product_block">
				<div class="thumbnail">
					<div class="prod_img_button">
						<?= Html::img("@web/img/products/{$popular->image}", ['alt' => $popular->name]) ?>
					</div>
					<div class="caption">
						<div class="prod_list_item_info">
							<h3><?= $popular->name?></h3>
							<p><?= $popular->description?></p>
						</div>
						<div class="prod_list_item_buttons">
								<a href="tartaletki.html" class="btn btn-default" role="button">Подробнее</a>
								<a href="#" class="btn btn-primary" role="button">
									Запомнить
									<i class="fa fa-heart-o" aria-hidden="true"></i>
								</a>
						</div>
					</div>
				</div>
			</div>				
			<?php endforeach;?>
			<div class="clearfix visible-sm-block visible-md-block visible-lg-block"></div>
			<div class="pagination_block">
				<?php
				echo LinkPager::widget([
				    'pagination' => $pages,
				]);
				?>
			</div>
			<?php endif; ?>

		</div>
	</div>


