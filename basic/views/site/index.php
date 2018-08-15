<?php
// $this->title = 'Кафе "Экспресс". Горячие обеды, организация банкетов, летнее вечернее кафе.';
use app\assets\AllAsset;
AllAsset::register($this);
?>
<?php use yii\helpers\Url; ?>
<?php use yii\helpers\Html; ?>

<!-- Если объявления есть -->
<?php if($advert) { ?>
<div  class="advert">
            <?php if(!Yii::$app->user->isGuest) { ?>
                <a href="<?= \yii\helpers\URL::to(['admin/advert/update', 'id'=>1]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:6px; top:25px;" target="_blank">
                    <span class="plus_cat">
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>                
            <?php } ?>       
    <div class="">
        <div class="close_advert">✕</div>
        <i class="fa fa-clock-o adv_clock" aria-hidden="true"></i>

        <span class="advert_text col-xs-12 col-sm-10 col-sm-offset-1">          
            <?= $advert->text?>
        </span>
    </div>
</div>
<?php } ?>
<!-- //Если объявления есть -->
<div class="page2" id="section2">
    <div class="container">
        <div class="page2_header">
            <h2>Меню</h2>
            <div class="short_line"></div>
            <div><span>Категории наших блюд</span></div>    
        </div>
        <div class="page2_categories">
            <?php foreach ($cats as $category) { ?>
            <?php if ($category->product) { ?>
                <div style="position:relative" class="col-xs-12 col-sm-6 col-md-4 col-lg-3 page2_category_item">  
                    <a href="<?= Url::to(['menu/view', 'id'=> $category->id]) ?>" style="text-decoration:none;">
                        <div class="category_block">                      
                            <span class="page2_cat_name"><?= $category->name ?></span>
                            <div class="img_block">
                                <?php if ($category->image) { ?>
                                <?= Html::img("@web/images/categories/266/{$category->image}", ['alt' => $category->name]) ?>
                                <?php } else { ?>
                                <?= Html::img("@web/images/categories/266/no-image.jpg", ['alt' => $category->name]) ?>
                                <?php } ?>
                            </div>
                            <span class="cat_count"><?= count($category->product) ?></span>
                        </div>
                    </a> 
                    <?php if(!Yii::$app->user->isGuest) { ?>
                        <a href="<?= \yii\helpers\URL::to(['admin/category/update', 'id'=>$category->id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
                            <span class="plus_cat">
                                <i class="fa fa-pencil"></i>
                            </span>
                        </a>                
                    <?php } ?>                 
                </div>                   
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<div class="page3" id="section3">
    <div class="container">
        <div class="col-xs-12 col-sm-6 ev">
            <div class="index_events_image">
                <img src="img/events.jpg" alt="Проведение мерроприятий в Кафе Экспресс">
            </div>
        </div>
        <div class="col-xs-12 col-sm-5 ev">
            <div class="wishlist_page_header">
                <h2>Организация мероприятий</h2>
                <p>Если вы хотите узнать подробности о проведении банкетов, свадеб, юбилеев, праздников или осуществить заказ блюд на вынос, то на нашем сайте вы можете ознакомиться с условиями их проведения и получить дополнительную информацию. </p>
                <a href="<?= Url::to(['site/events']) ?>" class="btn btn-primary">Узнать подробности</a>
            </div>
        </div>
    </div>
</div>