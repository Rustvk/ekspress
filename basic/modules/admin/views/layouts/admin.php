<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use app\assets\AllAsset;
use app\assets\MainAsset;
use app\assets\AdminAsset;

use app\components\ContactFormWidget;

// AllAsset::register($this);
MainAsset::register($this);
AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Панель администратора. <?= Html::encode($this->title) ?></title>

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

<body class="admin">
<?php $this->beginBody() ?>

<div class="wrapper">
	<nav class="navbar header" role="navigation" >
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
	            <li class="<?php if ((Yii::$app->controller->id)=='order') { ?>active <? } ?>">
	            	<a href="<?=  Url::to(['/admin/order']) ?>">Заказы</a>
	            </li>
	            <li  class="dropdown <?php if ((Yii::$app->controller->id)=='category') { ?>active <? } ?>">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['category/create'])?>">Создать категорию</a></li>
	              		<li><a href="<?= Url::to(['category/index'])?>">Список категорий</a></li>	              		
	              </ul>
	            </li>
	            <li  class="dropdown <?php if ((Yii::$app->controller->id)=='product') { ?>active <? } ?>">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Блюда <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['product/create'])?>">Создать блюдо</a></li>
	              		<li><a href="<?= Url::to(['product/index'])?>">Список блюд</a></li>	              		
	              </ul>
	            </li>
	            <li  class="dropdown <?php if ((Yii::$app->controller->id)=='ingredients') { ?>active <? } ?>">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ингредиенты <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['ingredients/create'])?>">Создать ингредиент</a></li>
	              		<li><a href="<?= Url::to(['ingredients/index'])?>">Список ингредиентов</a></li>	              		
	              </ul>
	            </li>	
	            <li  class="dropdown <?php if ((Yii::$app->controller->id)=='lunch') { ?>active <? } ?>">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Обед <b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu">
	              		<li><a href="<?= Url::to(['lunch/create'])?>">Создать блюдо</a></li>
	              		<li><a href="<?= Url::to(['lunch/index'])?>">Список блюд</a></li>	              		
	              </ul>
	            </li>	            
	          </ul>
	        </div>
	    <!-- /.Раскрываемое меню -->
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 pull-right sec_head">
				<!-- SEARCH -->
				<div class="col-xs-10 col-sm-6 col-md-7 col-lg-8 pull-right">
					<div class="search navbar-form navbar-right col-sm-12">
						<form method="get" action="<?= Url::to(['menu/search']) ?>" class="input-group input-group-sm">
							<input id="search-input" class="search_input" type="text" placeholder="Поиск по банкетному меню" name="q"></input>
							<span class="input-group-btn">
								<button class="fa fa-search search_icon" aria-hidden="true"></button>
							</span>
						</form>
					</div>
				</div>
				<!-- //SEARCH -->			           
	        </div> 
	    </div><!-- /.container-fluid -->	
		    <div class="container" style="text-align:right">
				<a href="<?= \yii\helpers\URL::to(['/admin']) ?>" class="btn btn-success"><?= Yii::$app->user->identity['username'] ?> (Панель администратора)</a>
				<a href="<?= \yii\helpers\URL::to(['/site/logout']) ?>" class="btn btn-primary"><?= Yii::$app->user->identity['username'] ?> (Выход)</a>

			</div>		    
    </nav>
    <div class="container">
	<?php if(Yii::$app->session->hasFlash('success')) {?>
		<br>
		<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php } ?>
		<?= $content ?>
		</div>

</div>

<?php $this->beginContent('@app/modules/admin/views/layouts/footer.php'); ?>
<?php $this->endContent(); ?>


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