<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>Просмотр заказа № <?= $model->id ?>, от <?= $model->name ?> </h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'created_at',
            'name',
            'phone',
            'email:email',
            [
                'attribute' => 'message',
                'format' => 'html',
            ],
            'qty',
            'summ',
            [
                'attribute' => 'status',
                'value' => $model->status==1 ? '<span class="text-danger">Активен</span>' : '<span class="text-success">Завершен</span>',
                // function($model) {
                //     if($model->status==1) {
                //         '<span class="text-danger">Активен</span>';
                //     }
                //     elseif($model->status==2) {
                //         '<span class="text-success">Завершен</span>';
                //     } 
                // },
                'format' => 'html',

            ],

            'to_date',
            'type',
        ],
    ]) ?>
</div>

<?php if (!empty($model->orderItems)) { ?>
<div class="wishcheck" style="margin: 0px; background:#fdfdfd; padding:20px;">
        <div class="wishlist_page_header">
            <h2>Список блюд</h2>
            <p>Список блюд, указанных в списке пожеланий от <?= $model->name ?></p>
        </div>

        <div class="wishlist_rows">
            <?php $items= $model->orderItems;?>
            <?php foreach($items as $item):?>
            <div style="padding:10px 10px 10px 0!important; border-bottom:1px solid #bdbdbd; ">
                <div style="">
                    <div class="order_name" style="width:220px; margin-right:10px;"><?= $item['name']?></div>
                    <div style="display:inline-block; margin-right:10px; vertical-align:top; border-left:1px solid #bdbdbd; padding-left:10px;"><?= $item['text']?></div>
                    <?php if (!empty($item['price'])) { ?><div class="list_price" style="display:inline-block; float:right"><?= $item['price']?> <span class="rub">Р</span></div>
                    <?php }
                    else  { ?>
                    <span class="list_price"></span>
                    <?php } ?>

                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class="wish_summ"> -->
            <!-- <span class="wish_summ_text">Итого наименований</span> -->
            <!-- <span class="wish_summ_num"><?php // $session['wishlist.qty']?></span> -->
        <!-- </div> -->
<!--        <div class="wish_summ">
            <span class="wish_summ_text">Сумма на человека</span>
            <span class="wish_summ_num"><?php // $session['wishlist.summ']?></span>
        </div>   -->
</div>
            <div href="#" class="printcheck btn btn-primary" style="margin:10px;">
                <i class="fa fa-print" aria-hidden="true"></i>
                <span>Распечатать</span>
            </div>
<?php } ?>