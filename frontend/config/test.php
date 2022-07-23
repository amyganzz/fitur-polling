<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            // 'basePath' => __DIR__ . '/../web/assets',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        // '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
                        // '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
                    ]
                ],
            ],
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];
