<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

		<div class="container vacancy" style="position:relative;">
		<ol class="breadcrumb">
		  <li><a href="<?= Url::Home()?>">Главная</a></li>
		  <li><a href="<?= Url::to(['vacancy/'])?>">Вакансии</a></li>
		  <li class="active"><?= $vacation->name ?></li>
		</ol>
			<div class="wishlist_page_header">
				    <?php if(!Yii::$app->user->isGuest) { ?>
				        <a href="<?= \yii\helpers\Url::to(['admin/vacancy/update', 'id'=>$vacation->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
				            <span class="plus_cat">
				                <i class="fa fa-pencil"></i>
				            </span>
				        </a>                
				    <?php } ?> 					
				<h1 class="h2"><?=$vacation->name?></h1>
				<p><?= $vacation->description?></p>
				<div class="h3"><?= $vacation->salary?> <span class="rub">Р</span></div>
			</div>

				<!-- <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vacancy_block"> -->
					<!-- <div class="thumbnail"> -->
							<?php // Html::img("@web/img/gallery/350/{$vacation->image}", ['alt' => $vacation->name, 'class' => 'img-fluid']) ?>
						<!-- </a>						 -->
					<!-- </div> -->
				<!-- </div> -->
		</div>
