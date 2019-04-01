# Tests

[Codeception](https://codeception.com/) is used for testing the module.

Preparing
---------

Install [composer](http://getcomposer.org/download/) dependencies
```
composer install
``` 

Rename `codeception.yml.dist` to `codeception.yml` and `/tests/\_app/config/db-local.php.dist` to `db-local.php`
Then create test DB (named `yii2seotest` by default) and set up it in both files.

Apply migrations
```
./tests/_app/yii migrate
```

Running Tests
-------------

```
./vendor/bin/codecept run
```