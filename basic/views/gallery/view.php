<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

		<div class="container album">
		<ol class="breadcrumb">
		  <li><a href="<?= Url::Home()?>">Главная</a></li>
		  <li><a href="<?= Url::to(['gallery/'])?>">Галерея</a></li>
		  <li class="active"><?= $album->name ?></li>
		</ol>
			<?php if( !empty($album) ): ?>
				<div class="wishlist_page_header" style="position:relative;">
				    <?php if(!Yii::$app->user->isGuest) { ?>
				    		<div class="clearfix"></div>
							<a href="<?= \yii\helpers\URL::to(['admin/albums/update', 'id'=>$album->id]) ?>"  target="_blank" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;">
								<span class="plus_cat">
									<i class="fa fa-pencil"></i>
								</span>
							</a>		    	
					<?php } ?>					
					<h1 class="h2"><?=$album->name?></h1>
					<p><?= $album->description?></p>
				</div>
    		<?php $gallery = $album->getImages(); ?>

			<?php foreach ($gallery as $photo): ?>
				<?php if($photo->isMain==0) { ?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 album_block">
					<div class="thumbnail">
						<a href="<?= Url::to($photo->getUrl('1500x'))?>" class="product_image_btn" data-toggle="lightbox" data-gallery="album-gallery">
							<?= Html::img($photo->getUrl('350x'), ['alt' => $album->name, 'class' => 'img-fluid']) ?>
							<i class="fa fa-search-plus" aria-hidden="true"></i>
						</a>						
					</div>
				</div>
				<?php } ?>
			<?php endforeach;?>	
			<?php else: ?>
				<div class="wishlist_page_header">
					<span class="h2">Нет ни одного альбома</span>
					<p>К сожалению на данный момент на сайте нет опубликованных альбомов. Приносим извинения за неудобства.</p>
				</div>
				<a class="btn  btn-primary" href="<?= Url::to(['gallery/index']) ?>"><span>Вернуться в галерею</span></a>
			<?php endif; ?>
		</div>
