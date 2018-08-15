<?php
use app\components\CompanyWidget;
use yii\helpers\Url;

?>
<footer>
	<div class="container" itemscope itemtype="http://schema.org/CafeOrCoffeeShop">
		<div class="col-xs-12 col-sm-4 col-md-3 footer_info">
			<p class="foot_h">
				<?=  str_replace(array("'",'"'),' ',CompanyWidget::widget(['object'=>'name']));  ?>
			</p>
			<span class="foot_desc">
				<?= CompanyWidget::widget(['object'=>'desc']); ?>
			</span>
			<div class="contact_foot_block">
				<div class="adress cf_item">
					<i class="col-xs-1 fa fa-map-marker" aria-hidden="true"></i>
					<span class="col-xs-11" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<?= CompanyWidget::widget(['object'=>'adress']); ?>
					</span>
				</div>
				<div class="clearfix visible-sm-block visible-xs-block"></div>
				<div class="phone cf_item">
					<i class="col-xs-1 fa fa-phone" aria-hidden="true"></i>
					<span class="col-xs-11">
						<?= CompanyWidget::widget(['object'=>'phone']); ?>
					</span>
				</div>
				<div class="clearfix visible-sm-block visible-xs-block"></div>
				<div class="mail cf_item">
					<i class="col-xs-1 fa fa-envelope" aria-hidden="true"></i>
					<span class="col-xs-11">
						<?= CompanyWidget::widget(['object'=>'mail']); ?>
					</span>
				</div>		
			</div>
		</div>
		<div class="col-xs-12 col-sm-2 col-sm-offset-1 col-md-offset-2 footer_cats">
			<p class="small_h_footer">Категории</p>
			<ul class="col-xs-12 col-md-8">
                <?= app\components\HeaderMenuWidget::widget(); ?>
<!-- 			<li><a href="#">Первые блюда</a></li>
				<li><a href="#">Вторые блюда</a></li>
				<li><a href="#">Закуски</a></li>
				<li><a href="#">Салаты</a></li>
				<li><a href="#">Напитки</a></li> -->
			</ul>
		</div>
		<div class="col-xs-12 col-sm-2 footer_map">
			<p class="small_h_footer">Карта сайта</p>
			<ul>
				<li><a href="<?= Url::Home() ?>">Главная</a></li>
				<li><a href="<?= Url::to('/menu')  ?>">Банкетное меню</a></li>
				<li><a href="<?= Url::to('/lunch')  ?>">Обеденное меню</a></li>
				<li><a href="<?= Url::to('/gallery')  ?>">Галерея</a></li>
				<li><a href="<?= Url::to(['/site/events'])?>">Организация</a></li>
			    <li><a href="<?= Url::to(['/site/about'])?>">О нас</a></li>
				<li><a href="<?= Url::to(['/vacancy'])?>">Вакансии</a></li>
			    <li><a href="<?= Url::to(['/site/contact'])?>">Контакты</a></li> 
			</ul>
		</div>
		<div class="col-xs-12 col-sm-3 footer_newsletter">
			<p class="small_h_footer">Подпишитесь на наши новости</p>
			<span>Получайте новости о мероприятиях и событиях в Кафе “Экспресс”</span>
			<div class="input-group input-group-sm newsletter_input_group">		
				<input type="email" class="newsletter_input" id="email" placeholder="Ваш E-mail">
				<span class="input-group-btn">
					<i class="fa fa-angle-right newsletter_icon" aria-hidden="true"></i>					
				</span><br>
				<div id="valid"></div>
			</div>			

		</div>

	</div>
</footer>