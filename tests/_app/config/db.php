<?php

use yii\db\Connection;
use yii\helpers\ArrayHelper;

$db = [
    'class' => Connection::class,
    'dsn' => 'mysql:host=127.0.0.1;dbname=yii2seotest',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

if (file_exists(__DIR__.'/db-local.php')) {
    $db = ArrayHelper::merge($db, require(__DIR__ . '/db-local.php'));
}
return $db;
