<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="close_orderitems">
    ✕
    <span>Изменения не сохранятся</span>
</div>
<?php // debug($categories) ?>
<?php $form = ActiveForm::begin(); ?>
    <div class="form-group field-order-products_ids">
        <label class="control-label"><h1>Выбрать блюда</h1></label>
        <hr>
        <input type="hidden" name="Order[products_ids]" value="">
        <ul id="order-products_ids" class="checkcategories">
            <?php foreach ($categories as $category): ?>
                <?php if ($category->product) {?>
                    <li><p><?=$category->name?></p>
                        <ul class="checkproducts">
                        <?php if ($category->parCategory) { ?>
                                <ul class="checkcategories" style="list-style:circle; padding-left:10px;">
                            <?php } ?>
                            <?php foreach ($category->parCategory as $subcat) { ?>
                                <li><p><?=$subcat->name?></p>
                                <ul class="checkproducts">
                                <?php foreach ($subcat->product as $subprod): ?>
                                <li class="checkitem">
                                    <input type="checkbox" name="Order[products_ids][]" id="cb_<?=$subprod->id?>" value="<?= $subprod->id ?>"
                                        <?php if (array_key_exists($subprod->id, $model->products_ids)) { ?>
                                                checked
                                        <?php } ?>
                                    >
                                    <label for="cb_<?=$subprod->id?>"><?=$subprod->name?></label>
                                    <input type="text" value="<?= $model->products_ids[$subprod->id]['text'] ?>" id="order-text" class="form-control checkprodtext checktext" name="Order[text][]" placeholder="Заметка по блюду">
                                    <input type="text" value="<?= $model->products_ids[$subprod->id]['price'] ?>" id="order-text" class="form-control checkprodtext checkprice" name="Order[price][]" placeholder="Цена">
                                </li>
                                <?php endforeach ?>
                                </ul> 
                                </li>                   
                            <?php } ?>   
                            <?php if ($category->parCategory) { ?>
                                </ul>                     
                            <?php } ?>                              
                        <?php foreach ($category->product as $product): ?>
                        <?php if ($product->subProducts) { ?>
                            <ul class="checkcategories" style="margin-left:5px;">
                                <li style="border-bottom:none;"><p><?=$product->name?> + </p>
                                    <ul class="checkproducts">                       
                                        <?php foreach ($product->subProducts as $subproduct) { ?>
                                            <li class="checkitem">
                                                <input type="checkbox" name="Order[products_ids][]" id="cb_<?=$subproduct->id?>" value="<?= $subproduct->id ?>"
                                                    <?php if (array_key_exists($subproduct->id, $model->products_ids)) { ?>
                                                            checked
                                                    <?php } ?>
                                                >
                                                <label for="cb_<?=$subproduct->id?>"><?=$product->name?>, <?=$subproduct->name?></label>
                                                <input type="text" value="<?= $model->products_ids[$subproduct->id]['text'] ?>" id="order-text" class="form-control checkprodtext checktext" name="Order[text][]" placeholder="Заметка по блюду">
                                                <input type="text" value="<?= $model->products_ids[$subproduct->id]['price'] ?>" id="order-text" class="form-control checkprodtext checkprice" name="Order[price][]" placeholder="Цена">
                                            </li>                                         
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        <?php } else {?>
                            <li class="checkitem">
                                <input type="checkbox" name="Order[products_ids][]" id="cb_<?=$product->id?>" value="<?= $product->id ?>"
                                    <?php if (array_key_exists($product->id, $model->products_ids)) { ?>
                                            checked
                                    <?php } ?>
                                >
                                <label for="cb_<?=$product->id?>"><?=$product->name?></label>
                                <input type="text" value="<?= $model->products_ids[$product->id]['text'] ?>" id="order-text" class="form-control checkprodtext checktext" name="Order[text][]" placeholder="Заметка по блюду">
                                <input type="text" value="<?= $model->products_ids[$product->id]['price'] ?>" id="order-text" class="form-control checkprodtext checkprice" name="Order[price][]" placeholder="Цена">
                            </li>
                        <?php } ?>                        
                        <?php endforeach ?>                        
                        </ul>                      
                    </li>
                <?php } ?>                
            <?php endforeach ?>
        </ul>
    </div>
<div class="form-group whiteback">
    <?= Html::submitButton('Сохранить набор', ['class' => 'btn btn-default savecheckproducts', 'id' => $model->id]) ?>
</div>
<?php ActiveForm::end(); ?>    
