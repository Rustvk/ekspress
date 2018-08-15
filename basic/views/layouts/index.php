<?php
use yii\helpers\Html;
// use app\assets\AllAsset;
use app\assets\IndexAsset;
use yii\helpers\Url;
use app\components\CompanyWidget;


// AllAsset::register($this);
IndexAsset::register($this);
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

</head>
<body class="main">
<?php $this->beginBody() ?>

<section class="page1 cd-section" id="section1">
	<div class="wrapper">
		<!-- Only on main page -->
		<div class="header_contacts navbar-static-top">
			<div class="container">
				<!-- CONTACTS -->
				<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4" >
					<span class="phone" style="padding-left:0"><i class="fa fa-phone" aria-hidden="true"></i><span>
						<?= CompanyWidget::widget(['object'=>'phone']); ?>
					</span></span>
					<span class="mail"><i class="fa fa-envelope" aria-hidden="true"></i><span>
						<?= CompanyWidget::widget(['object'=>'mail']); ?>
					</span></span>
				</div>
				<!-- //CONTACTS -->
				<div class="col-xs-12 col-sm-6 col-md-7 col-lg-8 sec_head">
					<!--WISHLIST-->
				<div class="wishlist no_js col-xs-2 col-sm-2 col-lg-1 pull-right" id="myWish">
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
				<div class="what first_what"  data-toggle="modal" data-target="#whatws">Что это?</div>

			          <!--//WISHLIST-->	
					<!-- SEARCH -->
					<div class="col-xs-10 col-sm-6 col-md-7 col-lg-4 pull-right">
						<div class="search navbar-form navbar-right col-sm-12">
							<div class="input-group input-group-sm">
								<input id="search-input" class="search_input" type="text" placeholder="Поиск по банкетному меню"/>
								<span class="input-group-btn">
									<i class="fa fa-search search_icon" aria-hidden="true"></i>
								</span>
							</div>
						</div>
					</div>
					<!-- //SEARCH -->			           
		          </div>    				
			</div>
		</div>
		<hr class="btw_head">
		<!---->	

		<nav class="navbar">
	      <div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	            <span class="sr-only">Меню</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
			  <a href="<?= Url::Home()  ?>" title="Кафе Экспресс" class="navbar-brand header-logo">
				<p class="logo-small">Кафе</p>
				<p class="logo-big">Экспресс</p>
			  </a>
	        </div>
			
	        <!-- Раскрываемое меню -->
		        <div class="navbar-collapse collapse menu_container" id="bs-example-navbar-collapse-1" style="height: 0.909091px;">
			
		          <ul class="nav navbar-nav menu navbar-right">
		            <li class="active"><a href="<?= Url::Home() ?>">Главная</a></li>
	            <li  class="dropdown
					<?php if (((Yii::$app->controller->action->id)!='search')&&((Yii::$app->controller->id)=='menu')) {
						?>active
						<?
					} ?>

	            ">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Меню <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['menu/index'])?>" >Банкетное меню</a>
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
					<li><a href="<?= Url::to('gallery/index')  ?>">Галерея</a></li>
					<li><a href="<?= Url::to(['site/events'])?>">Организация</a></li>
				    <li><a href="<?= Url::to(['site/about'])?>">О нас</a></li>
					<li><a href="<?= Url::to(['vacancy/index'])?>">Вакансии</a></li>
				    <li><a href="<?= Url::to(['site/contact'])?>">Контакты</a></li>  

		          </ul>
		          
		        </div>
		    <!-- /.Раскрываемое меню -->
			   			    
		    </div><!-- /.container-fluid -->	
	    <?php if(!Yii::$app->user->isGuest) { ?>
		    <div class="container" style="text-align:left">
				<a href="<?= \yii\helpers\URL::to(['/admin']) ?>" class="btn btn-default"  style="color:white!important">Админ</a>
				<a href="<?= \yii\helpers\URL::to(['/site/logout']) ?>" class="btn btn-default"  style="color:white!important">Выход</a>		    	
			</div>	
		<?php } ?>		    
	    </nav>
		<div class="pageheader">
			<h1>

			<span class="pageheaderleft">
				<span class="page-logo-small" style="display:block">Кафе</span>
				<span class="page-logo-big" style="display:inline-block">Экспресс</span>
			</span>
			<span class="pageheaderright" style="display: inline-block;">
				<span style="display:inline-block"><?= app\components\CompanyWidget::widget(['object'=>'desc']); ?></span>
				<!-- <p>Горячие обеды,</p><p>организация банкетов,</p><p>летнее вечернее кафе.</p> -->
			</span>
			</h1>
		</div>
        <div id="cd-vertical-nav" class="down_cont">
            <a href="#section2" class="down" data-number="2">
				<i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </div>
	</div>
</section>	

<?= $content; ?>

<?php  $this->beginContent('@app/views/layouts/footer.php'); ?>
<h1>HelloWorld</h1>
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