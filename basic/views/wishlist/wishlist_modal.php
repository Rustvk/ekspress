<?php use yii\helpers\Html; ?>
<?php use yii\helpers\Url; ?>
<div class="dropdown pull-right">
    <div class="dropdown-toggle">				
      	<div class="wish_icon">
		<?php if(!empty($session['wishlist'])) {?>
      		<i class="fa fa-heart full" aria-hidden="true"></i>
			<span class="wishlist_count"><?=$session['wishlist.qty']?></span>
		<?php } else { ?>
      		<i class="fa fa-heart-o full" aria-hidden="true"></i>
		<?php } ?>
		</div>
 	</div>
	<div class="list dropdown-menu">
		<?php if(!empty($session['wishlist'])):?>
			<div class="wishlist_header">
				<span class="wishlist_head">Список пожеланий <span class="what" data-toggle="modal" data-target="#whatws">Что это?</span></span>
				<div class="wishlist_cross close_wish">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
			</div>
			<div class="wish_items">
		        <?php foreach($session['wishlist'] as $id => $item):?>
				<div class="wish_row">
					<div class="wish_img">
						<?= Html::img("@web/images/products/266/{$item['img']}", ['alt' => $item['name']]) ?>
					</div>
					<div class="wish_inf">
						<a class="wish_name" href="<?= Url::to(['product/view', 'id'=> $item['parent_id']]) ?>"><span><?= $item['name']?></span></a>
						<a class="wish_cat" href="<?= Url::to(['menu/view', 'id'=> $item['category_id']]) ?>"><span><?= $item['category']?></span></a>
					</div>
					<div class="wish_remove pull-right" data-id="<?=$id?>">
						<i class="fa fa-close" aria-hidden="true"></i>
					</div>
				</div>
				<?php endforeach; ?>

			</div>
			<div class="wish_summ">
				<span class="wish_summ_text">Итого наименований</span>
				<span class="wish_summ_num"><?= $session['wishlist.qty']?></span>
			</div>
<!-- 			<div class="wish_summ">
				<span class="wish_summ_text">Сумма на человека</span>
				<span class="wish_summ_num"><?php // $session['wishlist.summ']?></span>
			</div>	 -->		
		<?php else: ?>
			<div class="wishlist_header">
				<span class="wishlist_head">Список пожеланий пуст
					<br><span class="what"  data-toggle="modal" data-target="#whatws">Что это?</span>
				</span>
				<div class="wishlist_cross close_wish">
						<span>✕</span>
				</div>
			</div>
		<?php endif; ?>
		<?php if(!empty($session['wishlist'])):?>
			<div class="wish_buttons">
				<a href="<?= Url::to(['wishlist/view', '#'=>'send-wishlist']) ?>" class="button more">Отправить</a>
				<a href="#" class="print">
					<i class="fa fa-print" aria-hidden="true"></i>
					<span>Распечатать</span>
				</a>
				<a href="<?= Url::to(['wishlist/view']) ?>">Подробнее</a>
				<a class="clear_wishlilst" href="<?= Url::to(['wishlist/clear']) ?>">Очистить список</a>
			</div>
		<?php endif ?>
	</div>
</div>		
<div class="is_added">Добавлено</div>
<div class="is_removed">Удалено</div>
