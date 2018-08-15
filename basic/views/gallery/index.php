<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

		<div class="container gallery">
			<?php if( !empty($gallery) ): ?>
				<div class="wishlist_page_header">
					<h1 class="h2">Фотогалерея</h1>
				</div>

			<?php foreach ($gallery as $album): ?>
    			<?php $img = $album->getImage(); ?>

				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 album_block">
					<div class="thumbnail">
						<h3><?= $album->name?></h3>						
						<p><?= $album->description?></p>
						<div class="album_photo">
							<?= Html::img($img->getUrl('350x'), ['alt' => $album->name, 'class' => 'img-fluid']) ?>
							<!-- <div class="album_hover"></div> -->
						</div>
						<div class="caption">
							<div class="prod_list_item_buttons">
							    <?php if(!Yii::$app->user->isGuest) { ?>
										<a href="<?= \yii\helpers\URL::to(['admin/albums/update', 'id'=>$album->id]) ?>"  target="_blank" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;">
											<span class="plus_cat">
												<i class="fa fa-pencil"></i>
											</span>
										</a>		    	
								<?php } ?>									
								<a href="<?= Url::to(['gallery/view', 'id'=>$album->id]) ?>" class="btn btn-default" role="button">Посмотреть фотографии</a>
							</div>
						</div>
					</div>

				</div>
			<?php endforeach;?>
			<?php else: ?>
				<div class="wishlist_page_header">
					<span class="h2">Нет ни одного альбома</span>
					<p>К сожалению на данный момент на сайте нет опубликованных альбомов. Приносим извинения за неудобства.</p>
				</div>
				<a class="btn  btn-primary" href="<?= Url::to(['site/index']) ?>"><span>Вернуться на главную</span></a>
			<?php endif; ?>
		</div>
