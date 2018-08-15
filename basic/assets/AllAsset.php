<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AllAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/owl.carousel.css',
        // 'css/owl.theme.default.css'
    ];
    public $js = [
        'js/bootstrap.js',
        'js/wishlist.js',
        'js/search.js',
        'js/subproduct.js',
        'js/owl.carousel.min.js',
        // 'js/masonry.pkgd.min.js',
        'js/down.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

}
