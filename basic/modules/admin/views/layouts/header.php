<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\components\BirthdayWidget;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <a href="<?= Url::to(Url::to(['/admin'])) ?>" class="logo">
        <span class="logo-mini"><small>Кафе</small></span><span class="logo-lg"><?= Yii::$app->name?></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                                 alt="User Image"/>
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user3-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            AdminLTE Design Team
                                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user4-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            Developers
                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user3-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            Sales Department
                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user4-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            Reviewers
                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                        </h4>
                                        <p>Why not buy a new awesome theme?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li> -->
                <!-- Tasks: style can be found in dropdown.less -->
                <?php if(BirthdayWidget::widget(['type'=>1])) { ?>
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-birthday-cake"></i>

                        <span class="label label-danger">
                            <?= BirthdayWidget::widget(['type'=>1]); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><b>Ближайшие дни рождения!</b></li>
                        <?= BirthdayWidget::widget(['type'=>2]); ?>
                    </ul>
                </li>

                <?php } ?>
                <!-- User Account: style can be found in dropdown.less -->
                <?= Html::a('<span>Перейти на сайт <i class="fa fa-external-link"></i></span>', Yii::$app->homeUrl, ['class' => 'admhome', 'target'=> '_blank']) ?>
                <li class="dropdown user user-menu pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php $image = Yii::$app->user->identity["image"] ?>
                        <?= Html::img('@web/img/admin/'.$image.'', ['alt' => $popular->name, 'class'=>'user-image']) ?>

                        <span class="hidden-xs"><?= Yii::$app->user->identity["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                        <?= Html::img('@web/img/admin/'.$image.'', ['alt' => $popular->name, 'class'=>'img-circle']) ?>
                            <p>
                                <?= Yii::$app->user->identity["name"] ?><br>
                            <small>
                                <?= Yii::$app->user->identity["username"] ?><br>
                                <?= Yii::$app->user->identity["age"] ?> лет<br>
                                <?= Yii::$app->user->identity["phone"] ?><br>
                                <?= Yii::$app->user->identity["adress"] ?><br>
                                <?= Yii::$app->user->identity["description"] ?><br>
                                <?= Yii::$app->user->identity["role"] ?>
                            </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Редактировать профиль</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li> -->
                    <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                <!-- </li> -->
            </ul>
        </div>
    </nav>
</header>
