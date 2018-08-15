<?php use yii\helpers\Url; ?>
<li>
	<a href="<?= Url::to(['menu/view', 'id'=> $category['id']]) ?>">
		<?= $category['name'] ?>
		<?php if ( isset($category['childs'])): ?>
			<span class="pull-right">
				<i class="fa fa-plus"></i>
			</span>
		<?php endif; ?>
	</a>
</li>