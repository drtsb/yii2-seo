<?php

namespace drtsb\yii\seo\tests\functional;

use app\models\Post;
use drtsb\yii\seo\tests\FunctionalTester;
use Yii;
use yii\base\InvalidConfigException;
use yii\console\Application;
use yii\console\Exception;

class ConsoleCest
{
    /**
     * @param FunctionalTester $I
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function testPostCreate(FunctionalTester $I)
    {
        $app = new Application(require dirname(__DIR__) . '/_app/config/console.php');
        $app->runAction('post/create');
        $I->seeRecord(Post::class, ['title' => 'Test Post']);
    }
}
