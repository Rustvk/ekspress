<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'layout' => 'main',
    'name' => 'Кафе "Экспресс"',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout'=>'main',
            // 'layout'=>'admin',
            // 'layoutPath'=>'@app/themes/adminLTE/layouts',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok 
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'images/gallery', //path to origin images
            'imagesCachePath' => 'images/gallery/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick' 
            'placeHolderPath' => '@webroot/images/gallery/no_image.jpg', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],        
        'components' => [
            'view' => [
                 'theme' => [
                     'pathMap' => [
                        '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                     ],
                 ],
            ],
        ],
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]        
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0bd9389237aa73fcf4af3b6f314be58584506b3c',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host'=>'smtp.mail.ru',
            'username' => 'mr-15@mail.ru',
            'password' => 'nokia5530xpressmusic',
            'port' => '465',
            'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // ['class'=>'app\components\SefRule', 'connectionID' => 'db'],
                'menu/<id:\d+>/page=<page:\d+>/size=<pageSize:\d+>/' => 'menu/view',
                'menu/<id:\d+>/size=<pageSize:\d+>/' => 'menu/view',
                'menu/<id:\d+>/page=<page:\d+>' => 'menu/view',
                'menu/<id:\d+>' => 'menu/view',
                'product/<id:\d+>' => 'product/view',
                'about' => 'site/about',
                'login' => 'site/login',
                'events' => 'site/events',
                'contact' => 'site/contact',
                '' => 'site/index',

                'menu/page=<page:\d+>/size=<pageSize:\d+>/' => 'menu/index',
                'menu/size=<pageSize:\d+>/' => 'menu/index',
                'menu/page=<page:\d+>' => 'menu/index', 
                'search/' => 'menu/search',
                'menu/' => 'menu/index',
                'lunch/' => 'lunch/index',
                'wishlist/' => 'wishlist/view',

                'vacation/<id:\d+>' => 'vacancy/view',
                'vacation/' => 'vacancy/index',

                'gallery/<id:\d+>' => 'gallery/view',
                'gallery/' => 'gallery/index',
                'images/' => 'yii2images/images/image-by-item-and-alias', 



            ],
        ],
        
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'/web',
                // 'basePath'=>'@webroot',            
                'path' => 'files',
                'name' => 'Files'
            ],
            // 'watermark' => [
            //             'source'         => __DIR__.'/logo.png', // Path to Water mark image
            //              'marginRight'    => 5,          // Margin right pixel
            //              'marginBottom'   => 5,          // Margin bottom pixel
            //              'quality'        => 95,         // JPEG image save quality
            //              'transparency'   => 70,         // Water mark image transparency ( other than PNG )
            //              'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
            //              'targetMinPixel' => 200         // Target image minimum pixel size
            // ]
        ]
    ],    
    'params' => [
        'company_id'=>'1'
    ],
];

// if (YII_ENV_DEV) {
//     // configuration adjustments for 'dev' environment
//     $config['bootstrap'][] = 'debug';
//     $config['modules']['debug'] = [
//         'class' => 'yii\debug\Module',
//     ];

//     $config['bootstrap'][] = 'gii';
//     $config['modules']['gii'] = [
//         'class' => 'yii\gii\Module',
//         'generators' => [ //here
//             'crud' => [ // generator name
//             'class' => 'yii\gii\generators\crud\Generator', // generator class
//             'templates' => [ //setting for out templates
//             'custom' => '@app/vendor/yiisoft/yii2-gii/generators/crud/custom', // template name => path to template
//             ]
//             ]
//         ],
//     ];
// }

return $config;
