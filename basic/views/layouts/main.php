<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AllAsset;
use app\assets\MainAsset;

use app\components\ContactFormWidget;

AllAsset::register($this);
MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
    <?php
       $this->registerJsFile('js/html5shiv.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
       $this->registerJsFile('js/respond.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
    ?>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body data-spy="scroll">


<?php $this->beginBody() ?>

<div class="wrapper">
	<nav class="navbar header">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Меню</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a href="<?= Url::Home() ?>" title="Кафе Экспресс" class="navbar-brand header-logo">
			<p class="logo-small">Кафе</p>
			<p class="logo-big">Экспресс</p>
		  </a>
        </div>
		
        <!-- Раскрываемое меню -->
	        <div class="navbar-collapse collapse menu_container col-lg-6" id="bs-example-navbar-collapse-1" style="height: 0.909091px;">
	          <ul class="nav navbar-nav menu navbar-right">
	            <li><a href="<?= Url::Home() ?>">Главная</a></li>
	            <li  class="dropdown
					<?php if (((Yii::$app->controller->action->id)!='search')&&(((Yii::$app->controller->id)=='menu')||((Yii::$app->controller->id)=='lunch'))) {
						?>active
						<?
					} ?>

	            ">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Меню <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['menu/index'])?>">Банкетное меню</a>
							<!-- <ul> -->
							  <?php // app\components\HeaderMenuWidget::widget(); ?>
							<!-- </ul> -->
	              		</li>
	              		<li><a href="<?= Url::to(['lunch/index'])?>">Обеденное меню</a>
							<!-- <ul> -->
							<!-- </ul> -->
	              		</li>	              		
	              </ul>
	            </li>
				<li
					<?php if ((Yii::$app->controller->id)=='gallery') {
						?>class="active"
						<?
					} ?>
					><a href="<?= Url::to(['gallery/index'])?>">Галерея</a></li>
			    <li <?php if ((Yii::$app->controller->action->id)=='about') {
						?>class="active"
						<?
					} ?>			    
					><a href="<?= Url::to(['site/about'])?>">О нас</a></li>


				<li
					<?php if ((Yii::$app->controller->action->id)=='events') {
						?>class="active"
						<?
					} ?>
				><a href="<?= Url::to(['site/events'])?>">Организация</a></li> 
				<li
					<?php if ((Yii::$app->controller->id)=='vacancy') {
						?>class="active"
						<?
					} ?>
				><a href="<?= Url::to(['vacancy/index'])?>">Вакансии</a></li>
			    <li
			    <?php if ((Yii::$app->controller->action->id)=='contact') {
						?>class="active"
				<? } ?>><a href="<?= Url::to(['site/contact'])?>">Контакты</a></li>				
	          </ul>
	          
	        </div>
	    <!-- /.Раскрываемое меню -->
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right sec_head">
				<!--WISHLIST-->
				<div class="wishlist no_js col-xs-2 col-sm-2 col-lg-2 pull-right" id="myWish">
					<div class="dropdown pull-right">
					    <a href="<?= Url::to(['wishlist/view']) ?>" class="dropdown-toggle">				
					      	<div class="wish_icon">
							<?php if(!empty( Yii::$app->session['wishlist'])) {?>
					      		<i class="fa fa-heart full" aria-hidden="true"></i>
								<span class="wishlist_count"><?= Yii::$app->session['wishlist.qty']?></span>
							<?php } else { ?>
					      		<i class="fa fa-heart-o full" aria-hidden="true"></i>
							<?php } ?>
							</div>
					 	</a>
					</div>
		        </div>
				<div class="what first_what_main"  data-toggle="modal" data-target="#whatws">Что это?</div>

			    <!--//WISHLIST-->	
				<!-- SEARCH -->
				<div class="col-xs-10 col-sm-6 col-md-7 col-lg-8 pull-right">
					<div class="search navbar-form navbar-right col-sm-12">
						<form method="get" action="<?= Url::to(['menu/search']) ?>" class="input-group input-group-sm">
							<input id="search-input" class="search_input" type="text" placeholder="Поиск по банкетному меню" name="q"/>
							<span class="input-group-btn">
								<button class="fa fa-search search_icon" aria-hidden="true"></button>
							</span>
						</form>
					</div>
				</div>
				<!-- //SEARCH -->			           
	        </div> 

	    </div><!-- /.container-fluid -->
	    <?php if(!Yii::$app->user->isGuest) { ?>
		    <div class="container" style="text-align:left">
				<a href="<?= \yii\helpers\URL::to(['/admin']) ?>" class="btn btn-default">Админ</a>
				<a href="<?= \yii\helpers\URL::to(['/site/logout']) ?>" class="btn btn-default">Выход</a>
			</div>	
		<?php } ?>
    </nav>
		<?= $content ?>

</div>


<?php  $this->beginContent('@app/views/layouts/footer.php'); ?>
<?php  $this->endContent(); ?>


<div class="overlay close_wish"></div>
<div class="search_list">
	<div class="page_header">
		<div class="h4" style="text-align:center">Введите наименование блюда, или категории</div>
	</div>
</div>
<div class="close_search">✕</div>
<?php  $this->beginContent('@app/views/layouts/what_is_wl.php'); ?>
<?php  $this->endContent(); ?>
<div class="wishlist_print"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>