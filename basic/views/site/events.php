<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
		<div class="container events">
			<?php if( !empty($events) ): ?>
				<div class="wishlist_page_header">
					<h1 class="h2">Организация мероприятий</h1>
					<p>На данной странице вы можете детальнее ознакомиться с условиями организации мероприятий</p>
				</div>
			<?php foreach ($events as $event): ?>

				<div class="vacation" style="position:relative;">
					<div class="vacation_block">
					    <?php if(!Yii::$app->user->isGuest) { ?>
					        <a href="<?= \yii\helpers\Url::to(['admin/events/update', 'id'=>$event->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
					            <span class="plus_cat">
					                <i class="fa fa-pencil"></i>
					            </span>
					        </a>                
					    <?php } ?>  						
						<h3><?= $event->name?></h3>						
						<p><?= $event->description?></p>
					</div>
				</div>
				<hr>
			<?php endforeach;?>
			<?php else: ?>
				<div class="wishlist_page_header">
					<span class="h2">Организация мерроприятий</span>
					<p>К сожалению на данный момент по этому разделу отсутствует информация.</p>
				</div>
				<a class="btn  btn-primary" href="<?= Url::to(['site/index']) ?>"><span>Вернуться на главную</span></a>
			<?php endif; ?>
		</div>
