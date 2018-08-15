<?php use yii\helpers\Html; ?>
<?php use yii\helpers\Url; ?>
<?php use yii\bootstrap\ActiveForm; ?>
<?php use yii\captcha\Captcha; ?>

<div class="container wishlist_page">
	<?php if(!empty($session['wishlist'])):?>
		<div class="wishlist_page_header">
			<span class="h2">Список пожеланий</span>
			<p>Список пожеланий позволяет в удобном формате определить перечень блюд в меню вашего мероприятия. <br>Вы можете распечатать его для демонстрации при очной встрече, либо отправить к нам на почту.</p>
		</div>

		<div class="wishlist_rows">
	        <?php foreach($session['wishlist'] as $id => $item):?>

			<div class="wish_row">
				<div class="wish_img">
					<?= Html::img("@web/images/products/266/{$item['img']}", ['alt' => $item['name']]) ?>
				</div>
				<div class="wish_inf">
					<a class="wish_name" href="<?= Url::to(['product/view', 'id'=> $item['parent_id']]) ?>">
						<span><?= $item['name']?></span>
					</a>
					<a class="wish_cat" href="<?= Url::to(['menu/view', 'id'=> $item['category_id']]) ?>">
						<span><?= $item['category']?></span>
					</a>
				</div>
				<div class="wish_inf">
					<?php if (!empty($item['price'])) { ?><div class="list_price"><?= $item['price']?> <span class="rub">Р</span></div>
					<?php }
					else  { ?>
					<div class="list_price">-</span></div>
					<?php } ?>
				</div>
				<a href="<?= Url::to(['wishlist/delete', 'id'=> $id])?>" class="del pull-right" data-id="<?=$id?>">
					<i class="fa fa-close" aria-hidden="true"></i>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="wish_summ">
			<span class="wish_summ_text">Итого наименований</span>
			<span class="wish_summ_num"><?= $session['wishlist.qty']?></span>
		</div>
<!-- 		<div class="wish_summ">
			<span class="wish_summ_text">Сумма на человека</span>
			<span class="wish_summ_num"><?php // $session['wishlist.summ']?></span>
		</div>	 -->

	<?php else: ?>
		<div class="wishlist_page_header">
			<span class="h2">Список пожеланий пуст</span>
			<p>Список пожеланий позволяет в удобном формате определить перечень блюд в меню вашего мероприятия. <br>Вы можете распечатать его для демонстрации при очной встрече, либо отправить к нам на почту.</p>
		</div>
		<a class="btn  btn-primary" href="<?= Url::to(['menu/index']) ?>"><span>Вернуться в меню</span></a>
		</div>
	<?php endif; ?>
	<?php if(!empty($session['wishlist'])):?>
		<div class="wish_buttons ">
			<a href="#" class="print pull-left">
				<i class="fa fa-print" aria-hidden="true"></i>
				<span>Распечатать</span>
			</a>
			<a href="#" class="send_list pull-left" id="send-wishlist">Отправить список</a>
			<a class=" pull-right" href="<?= Url::to(['wishlist/clear']) ?>">Очистить список</a>

		</div>
	<?php endif ?>
</div>

<?php if(Yii::$app->session->hasFlash('success')) {?>
<div class="order send">
    <div class="close_order">✕</div>
    <h3>Ваше письмо отправлено!</h3> <p>Спасибо за заявку, в скором времени мы свяжемся с вами.</p>
</div>

<?php } elseif(Yii::$app->session->hasFlash('error')) { ?>
<div class="order send">
    <div class="close_order">✕</div>
    <h3>Ошибка!</h3> <p>В результате отправки возникла ошибка, пожалуйста попробуйте снова.</p>
</div>
<?php } else { ?>
<div class="order">
    <div class="close_order">✕</div>
    <div class="h3">Форма отправки меню</div>
    <p>Список будет отправлен на нашу почту, о чем мы будем сразу уведомлены</p>
    <p>Поля со звездочкой * являются обязательными</p>
    <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>
        <div class="col-xs-12 col-md-6 contact_rows">
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-9999',
            ]) ?>
            <?= $form->field($order, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div><div class="col-xs-5">{image}</div><div class="col-xs-6 pull-right">{input}</div></div>',
            ]) ?>             
        </div>
        <div class="col-xs-12 col-md-6 contact_rows">
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'message')->textarea(['rows' => 4]) ?>       
        </div>
        <div class="form-group col-xs-12" style="text-align:center;">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'order-button']) ?>
        </div>              
    <?php ActiveForm::end(); ?> 
</div>

<?php } ?>
