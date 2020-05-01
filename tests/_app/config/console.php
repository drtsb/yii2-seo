<?php

use yii\console\controllers\MigrateController;
use yii\log\FileTarget;
use yii\caching\FileCache;

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
        '@drtsb/yii/seo' => dirname(__DIR__, 3) . '/src',
    ],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
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
            'class' => MigrateController::class,
            'migrationNamespaces' => [
                'drtsb\yii\seo\migrations',
            ],
        ],
    ],
];
