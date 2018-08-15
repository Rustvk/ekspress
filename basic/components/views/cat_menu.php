<?php use yii\helpers\Url;
	$class='';
	if ($category['id']==$this->active) {
	$class='active show_sub_cat';
	}
	if ($category['id']==$this->xxx) {
	$class.='show_sub_cat ';
	}
?>
<li class="<?=$class?>">
    <?php if(!Yii::$app->user->isGuest) { ?>
		<a href="<?= \yii\helpers\URL::to(['admin/category/update', 'id'=>$category['id']]) ?>" class="pull-right cat_adm" style="position:absolute; left:-30px;" target="_blank">
			<span class="plus_cat">
				<i class="fa fa-pencil"></i>
			</span>
		</a>		    	
	<?php } ?>	
	<a href="<?= Url::to(['menu/view', 'id'=> $category['id'], '#'=>'list']) ?>">
		<?= $category['name']; ?>
	</a>
		<?php  if ( isset($category['childs'])): ?>
			<span class="plus_cat">
				<i class="fa fa-plus"></i>
			</span>
		<?php  endif; ?>		
	<?php if( isset($category['childs'])): ?>
		<ul>
			<?= $this->getMenuHtml($category['childs']) ?>
		</ul>
	<?php endif; ?>
</li>