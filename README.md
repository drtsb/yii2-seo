# yii2-seo

Yii2 SEO module

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


Either run

```
composer require bastardijke/yii2-seo:*
```
or add

```json
"bastardijke/yii2-seo" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

```
yii migrate --migrationPath=@vendor/bastardijke/yii2-seo/migrations
```
or add
```php
'controllerMap' => [
    ...
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'bastardijke\yii2-seo\migrations',
        ],
    ],
    ...
],
```
to your apllication config file.
