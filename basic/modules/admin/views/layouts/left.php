<?
use yii\helpers\html;
use app\modules\admin\components\OrderCountWidget;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php $image = Yii::$app->user->identity["image"] ?>
                <?= Html::img('@web/img/admin/'.$image.'', ['alt' => $popular->name, 'class'=>'img-circle']) ?>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity['username']?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--         <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Панель управления', 'options' => ['class' => 'header']],
                    // ['label' => 'Заказы', 'icon' => 'book', 'url' => ['order/index'],],
                    ['label' => 'Кафе "Экспресс"', 'icon' => 'gear', 'url' => ['company/index', 'id'=>1],],
                    [
                        'label' => '<span>Заказы</span><span class="pull-right-container"><small class="label pull-right bg-red">' . OrderCountWidget::widget() . '</small></span>',
                        'icon' => 'book',
                        'url' => ['order/index'],
                        'encode' => false,
                    ],                    
                    [
                        'label' => 'Банкетные блюда',
                        'icon' => 'cutlery',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Список блюд', 'icon' => 'list-ul', 'url' => ['product/index'],],
                        ['label' => 'Создать блюдо', 'icon' => 'plus', 'url' => ['product/create'],],
                        ['label' => 'Список категорий', 'icon' => 'list', 'url' => ['category/index'],],
                        ['label' => 'Создать категорию', 'icon' => 'plus', 'url' => ['category/create'],],                        
                        ],
                    ],
                    [
                        'label' => 'Обеденные блюда',
                        'icon' => 'coffee',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Просмотр меню', 'icon' => 'file-text-o', 'url' => ['lunchproducts/menu'],],                        
                        ['label' => 'Список блюд', 'icon' => 'list-ul', 'url' => ['lunchproducts/index'],],
                        ['label' => 'Создать блюдо', 'icon' => 'plus', 'url' => ['lunchproducts/create'],],
                        ['label' => 'Список категорий', 'icon' => 'list', 'url' => ['lunchcategories/index'],],
                        ['label' => 'Создать категорию', 'icon' => 'plus', 'url' => ['lunchcategories/create'],],
                        ],
                    ],                    
                    [
                        'label' => 'Ингредиенты',
                        'icon' => 'tint',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Список ингредиентов', 'icon' => 'list-ul', 'url' => ['ingredients/index'],],
                        ['label' => 'Создать ингредиент', 'icon' => 'plus', 'url' => ['ingredients/create'],],
                        ],
                    ],                    
                    ['label' => 'Сотрудники', 'icon' => 'user', 'url' => ['employees/index'],],
                    [
                        'label' => 'Страницы сайта',
                        'icon' => 'files-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Главная (объявление)', 'icon' => 'comment', 'url' => ['advert/index', 'id'=>1],],
                            ['label' => 'Вакансии', 'icon' => 'group', 'url' => ['vacancy/index'],],
                            ['label' => 'Организация', 'icon' => 'info-circle', 'url' => ['events/index'],],
                            ['label' => 'О нас', 'icon' => 'university', 'url' => ['pages/view', 'id'=>1],],
                            ['label' => 'Галерея', 'icon' => 'image', 'url' => ['albums/index'],],
                        ],
                    ],                       
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],                    
                ],
            ]
        ) ?>

    </section>

</aside>
