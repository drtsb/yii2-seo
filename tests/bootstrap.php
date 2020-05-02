<?php
/** phpcs:ignoreFile */
// ensure we get report on all possible php errors
use Codeception\Util\Autoload;

error_reporting(-1);

define('YII_ENABLE_ERROR_HANDLER', false);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('YII_DEBUG', true);

$_SERVER['SCRIPT_NAME'] = '/' . __DIR__;
$_SERVER['SCRIPT_FILENAME'] = __FILE__;

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php');

//Yii::setAlias('@extension', __DIR__ . '/../');
