<?php

$db = require __DIR__ . '/db.php';

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
        '@drtsb/yii/seo' => dirname(dirname(dirname(__DIR__))) . '/src',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => [],
    
    'controllerMap' => [
/*        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],*/
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'drtsb\yii\seo\migrations',
            ],
        ],
    ],
    
];