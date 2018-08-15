<?php use yii\helpers\Html; ?>
<?php use yii\helpers\Url; ?>
<?php use yii\bootstrap\ActiveForm; ?>
<?php use yii\captcha\Captcha; ?>

<div style=" position: relative; text-align: left; padding-right: 15px; margin-right: auto; margin-left: auto;">
		<div style="text-align: left; padding-top: 20px; padding-bottom: 20px; padding-left:20px;">
			<span style="margin-top: 20px; margin-bottom: 10px; font-size: 30px; font-weight:100!important; color: #444!important;">Заявка на меню</span>
		</div>
		<div style="padding-left:20px"><p>От: <?= $order->name ?></p>
			<p>Телефон: <?= $order->phone ?></p>
			<?php if ($order->message) { ?>
			<p>Сообщение: <?= $order->message ?></p>
			<?php } ?>
			<?php if ($order->message) { ?>
			<p>Email: <?= $order->email ?></p>
			<?php } ?>
		</div>		
		<div class="wishlist_rows">
	        <?php foreach($session['wishlist'] as $id => $item):?>
			<div style="position:relative; text-align:center; padding:15px 20px; text-align:left; border-top:1px dashed #d8d8d8;">
				<div style="color: #444; width: 150px; display: inline-block; vertical-align: middle;">
					<a style="text-decoration: none; color: inherit;" href="<?= Url::to(['product/view', 'id'=> $id]) ?>"><span><?= $item['name']?></span></a>
					<a style="display: block; font-size: 12px; font-weight: 400;" href="<?= Url::to(['menu/view', 'id'=> $item['category_id']]) ?>">
						<span><?= $item['category']?></span>
					</a>
				</div>
				<div style="color: #444; width: 150px; display: inline-block; vertical-align: middle;">
					<?php if (!empty($item['price'])) { ?><div class="list_price"><?= $item['price']?> <span class="rub">Р</span></div>
					<?php }
					else  { ?>
					<div style="font-size: 24px;">-</span></div>
					<?php } ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div style="color: #444; margin: 0 0 20px; padding: 16px 20px; border-top: 1px solid #eee; height: 10px;">
			<span class="wish_summ_text" style="float: left;">Итого наименований</span>
			<span class="wish_summ_num" style="float: right;"><?= $session['wishlist.qty']?></span>
		</div>
<!-- 		<div style="color: #444; margin: 0 0 20px; padding: 16px 28px; border-top: 1px solid #eee; height: 10px;">
			<span class="wish_summ_text" style="float: left;">Сумма на человека</span>
			<span class="wish_summ_num" style="float: right;"><?php // $session['wishlist.summ']?></span>
		</div>	 -->
</div>
