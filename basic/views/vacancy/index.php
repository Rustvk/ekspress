<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
		<div class="container vacancy">
			<?php if( !empty($vacancy) ): ?>
				<div class="wishlist_page_header">
					<h1 class="h2">Вакансии</h1>
					<p>Если вас заинтересовала вакансия, вы можете позвонить по номеру <?=$company->phone ?> или <?= $company->mobile_phone?></p>
				</div>
			<?php foreach ($vacancy as $vacation): ?>

				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 vacation">
					<div class="vacation_block">
					    <?php if(!Yii::$app->user->isGuest) { ?>
					        <a href="<?= \yii\helpers\Url::to(['/admin/vacancy/update', 'id'=>$vacation->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
					            <span class="plus_cat">
					                <i class="fa fa-pencil"></i>
					            </span>
					        </a>                
					    <?php } ?>  						
						<h3><?= $vacation->name?></h3>						
						<p><?= $vacation->short_description?></p>
						<div class="h3"><?= $vacation->salary?> <span class="rub">Р</span></div>
					<div class="caption">
						<div class="prod_list_item_buttons">
							<a href="<?= Url::to(['/vacancy/view', 'id'=>$vacation->id]) ?>" class="btn btn-default" role="button">Ознакомиться с вакансией</a>
						</div>
					</div>
					</div>
				</div>
			<?php endforeach;?>
			<?php else: ?>
				<div class="wishlist_page_header">
					<span class="h2">Вакансий не найдено</span>
					<p>К сожалению на данный момент на сайте нет опубликованных вакансий.</p>
				</div>
				<a class="btn  btn-primary" href="<?= Url::to(['/site/index']) ?>"><span>Вернуться на главную</span></a>
			<?php endif; ?>
		</div>
