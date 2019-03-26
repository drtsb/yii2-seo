<?php
$db = require __DIR__ . '/db.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'yii2-seo-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@vendor' => dirname(dirname(dirname(__DIR__))) . '/vendor',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'modules' => [
        'seo' => [
            'class' => 'drtsb\yii\seo\Module',
            //'accessRoles' => ['admin'],
            //'pagination' => ['pageSize' => 10],
        ],
    ],
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
    ],
    'params' => [],
];
