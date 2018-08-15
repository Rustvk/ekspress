<?php if ($success) { ?> 
<div id="w1-success" class="alert-success alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fa fa-check"></i>
<?=$content;?>
</div

<?php } else { ?>
<div id="w1-success" class="alert-danger alert fade in">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="icon fa fa-close"></i>
<?=$content;?>
</div

<?php } ?>