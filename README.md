# yii2-seo

Yii2 SEO module

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).


Either run

```
composer require drtsb/yii2-seo:*
```
or add

```json
"drtsb/yii2-seo" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

The extension consists of 2 parts:
- **Module** provides a simple CRUD to edit SEO params for pages specified by controller and action.
- **ModelBehavior** adds SEO fields to specific model.


First of all, you need to apply migrations
```
yii migrate --migrationPath=@vendor/drtsb/yii2-seo/src/migrations
```
or add
```php
'controllerMap' => [
    ...
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'drtsb\yii\seo\migrations',
        ],
    ],
    ...
],
```
to your apllication config file.

### Module configuration
```php
'modules' => [
	...
    'seo' => [
        'class' => 'drtsb\yii\seo\Module',
        'accessRoles' => ['admin'], // Default: null
        'pagination' => ['pageSize' => 10], // Default: false
    ],
    ...
],
```
After that, you can manage your SEO by accessing `/seo/default` 

You can use **\*** mask at **Controller** and **Action** fields
For example, for page **site/index** will be used first appropriate row in following order:

| Order    | Controller  | Action  | Title                                    | Meta Description |
| :------: | :---------: | :-----: | :--------------------------------------: | :--------------: |
| 1        | site        | index   | Title for site/index                     | ...              |
| 2        | site        | *       | Title for any action of site controller  | ...              |
| 3        | *           | index   | Title for index action of any controller | ...              |
| 4        | *           | *       | Title for any action of any controller   | ...              |


Add behavior to your frontend controller
```php
use drtsb\yii\seo\behaviors\SeoBehavior;

public function behaviors()
{
    return [
        SeoBehavior::class,
    ];
}
```


### Working with models

Add behavior to your model

```php
public function behaviors()
{
    return [
        'seo' => [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
        ],
    ];
}
```

add to model's form 
```php
<?= $model->seoFields($form) ?>
```


Register meta tags at frontend view
```php
MetaTagsWidget::widget(['view' => $this, 'model' => $model]);
```