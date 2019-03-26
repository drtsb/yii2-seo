# Tests

[Codeception](https://codeception.com/) is used for testing the module.

Preparing
---------

Install [composer](http://getcomposer.org/download/) dependencies
```
composer install
``` 

Rename **codeception.yml.dist** to **codeception.yml** and **/tests/\_app/config/db.php.dist** to **db.php**
Then set up your DB settings in both files.

Apply migrations
```
./tests/_app/yii migrate
```

Running Tests
-------------

```
./vendor/bin/codecept run
```