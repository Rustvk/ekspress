<?php
use app\components\CompanyWidget;
use yii\helpers\Url;

?>
<footer>
	<div class="container">
		<div class="col-xs-12 col-sm-4 col-md-5 footer_info">
			<p class="foot_h">
				<?= str_replace(array("'",'"'),' ',Company::widget(['name']));  ?><span>&nbsp;</span>
			</p>
			<span class="foot_desc">
				<?= CompanyWidget::widget(['object'=>'desc']); ?>
			</span>
		</div>
		<!-- <div class="col-xs-12 col-sm-2 col-sm-offset-1 col-md-offset-2 footer_cats"> -->
			<!-- <p class="small_h_footer">Категории</p> -->
			<!-- <ul class="col-xs-12 col-md-8"> -->
                <?php // app\components\HeaderMenuWidget::widget(); ?>
<!-- 			<li><a href="#">Первые блюда</a></li>
				<li><a href="#">Вторые блюда</a></li>
				<li><a href="#">Закуски</a></li>
				<li><a href="#">Салаты</a></li>
				<li><a href="#">Напитки</a></li> -->
			<!-- </ul> -->
		<!-- </div> -->
		<div class="col-xs-12 col-sm-7 footer_map">
			<p class="small_h_footer">Карта сайта</p>
				<div style="display: inline-block;"><a style="padding:5px; padding-left:0" href="<?= Url::Home() ?>">Главная</a></div>
				<div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/menu'])?>">Банкетное меню</a></div>
				<div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/lunch'])?>">Обеденное меню</a></div>
				<div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/gallery'])?>">Галерея</a></div>
				<div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/site/events'])?>">Организация</a></div>
			    <div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/site/about'])?>">О нас</a></div>
			    <div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/site/contact'])?>">Контакты</a></div> 
				<div style="display: inline-block;"><a style="padding:5px;" href="<?= Url::to(['/vacancy'])?>">Вакансии</a></div>
		</div>
<!-- 		<div class="col-xs-12 col-sm-3 footer_newsletter">
			<p class="small_h_footer">Подпишитесь на наши новости</p>
			<span>Получайте новости о мерроприятиях и событиях в Кафе “Экспресс”</span>
			<div class="input-group input-group-sm newsletter_input_group">
				<input type="text" class="newsletter_input" placeholder="Ваш E-mail">
				<span class="input-group-btn">
					<i class="fa fa-angle-right newsletter_icon" aria-hidden="true"></i>					
				</span>
			</div>			
		</div> -->

	</div>
</footer>