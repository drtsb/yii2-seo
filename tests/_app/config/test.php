<?php

use app\models\User;
use drtsb\yii\seo\Module;

$db = require __DIR__ . '/db.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'yii2-seo-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@vendor' => dirname(__DIR__, 3) . '/vendor',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'modules' => [
        'seo' => [
            'class' => Module::class,
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
            'basePath' => dirname(__DIR__) . '/web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => User::class,
        ],
    ],
    'params' => [],
];
