<div class="container about" style="position:relative;">
 	<?php if(!Yii::$app->user->isGuest) { ?>
		<a href="<?= \yii\helpers\Url::to(['admin/pages/update', 'id'=>$about->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
			<span class="plus_cat">
				<i class="fa fa-pencil"></i>
			</span>
		</a>		    	
	<?php } ?>	
	<?= $about->content ?>
</div>
