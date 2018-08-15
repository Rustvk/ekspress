<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
// $this->title = 'Contact';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container contact" style="position:relative">
    <?php if(!Yii::$app->user->isGuest) { ?>
        <a href="<?= \yii\helpers\Url::to(['admin/company/update', 'id'=>$company->company_id]) ?>" class="" style="vertical-align:middle; padding: 4px 8px; position:absolute; right:13px; top:5px;" target="_blank">
            <span class="plus_cat">
                <i class="fa fa-pencil"></i>
            </span>
        </a>                
    <?php } ?>      
    <div itemscope itemtype="http://schema.org/CafeOrCoffeeShop">
        <div class="wishlist_page_header">
            <h1 class="h2">Контактные данные <span itemprop="name">кафе "Экспресс"</span></h1>
            <p>На данной странице вы найдете данные для связи с кафе "Экспресс": телефон, адрес, электронная почта.<br>
            Если у вас есть вопросы, предложения или пожелания, пожалуйста заполните форму обратной связи.</p>
        <hr>
        </div>
        <!-- <div class="col-xs-12 col-sm-6 col-md-3 contact_item_block"> -->
<div class="col-xs-12 col-md-6">
    <div class="col-xs-12 col-md-6 contact_item_block">
        <div class="contact_item">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <p itemprop="faxNumber"><?= $company->phone ?></p>
            <p itemprop="telephone"><?= $company->mobile_phone ?></p>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 contact_item_block">
        <div class="contact_item">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <p>
                <?= $company->work_hours ?>
<!--                     <time itemprop="openingHours" datetime="Mo-Su 10:00−16:00">Пн-Сб: 10.00 - 16.00<br>
                </time>
                Пт, Сб: Вечерняя работа по заявкам до 01.00<br>
                Вс: Выходной -->
            </p>
        </div>
    </div>     
    <!-- <div class="col-xs-12 col-sm-6 col-md-3 contact_item_block"> -->
    <div class="col-xs-12 col-md-6 contact_item_block">
        <div class="contact_item">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <?= $company->adress ?>
            </p>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 contact_item_block">
        <div class="contact_item">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <p itemprop="email"><?= $company->mail ?></p>
        </div>
    </div>      
    <!-- <div class="col-xs-12 col-sm-6 col-md-3 contact_item_block"> -->
    <!-- <div class="col-xs-12 col-sm-6 col-md-3 contact_item_block"> -->   
</div>

        <div class="content_item_block col-xs-12 col-md-6">
                <div class="requisites contact_item"  style="min-height:440px!important; height:auto; margin:20px; text-align:left;">
                    <?= $company->requisites ?>
                </div>
        </div>    
    </div>
<?php if(Yii::$app->session->hasFlash('success')) {?>
<div class="order send">
    <div class="close_order">✕</div>
    <h3>Ваше письмо отправлено!</h3> <p>Спасибо за заявку, в скором времени мы свяжемся с вами.</p>
</div>

<?php } elseif(Yii::$app->session->hasFlash('error')) { ?>
<div class="order send">
    <div class="close_order">✕</div>
    <h3>Ошибка!</h3> <p>В результате отправки возникла ошибка, пожалуйста попробуйте снова.</p>
</div>
<?php } ?>
<div class="contact_block col-xs-12">
    <div class="col-xs-12 col-md-8">
        <div class="form_header" style="margin-left:20px;">
            <div class="h3">Форма обратной связи</div>
            <p>Поля со звездочкой * являются обязательными</p>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>
            <div class="col-xs-12 col-md-6 contact_rows">
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '+7 (999) 999-9999',
                ]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div><div class="col-xs-5">{image}</div><div class="col-xs-6 pull-right">{input}</div></div>',
                ]) ?>             
            </div>
            <div class="col-xs-12 col-md-6 contact_rows">
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'message')->textarea(['rows' => 4]) ?>       
            </div>
            <div class="form-group col-xs-12" style="text-align:center;">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'order-button']) ?>
            </div>              
        <?php ActiveForm::end(); ?> 
    </div>
</div>
</div>
