<?php

namespace drtsb\yii\seo\tests\unit\models;

use Codeception\Test\Unit;
use drtsb\yii\seo\models\SeoModel;
use app\models\Post;

class SeoModelTest extends Unit
{
    public function testUniqueModel()
    {
        $model = new SeoModel(['model_name' => Post::class, 'model_id' => 1]);
        $this->assertEquals(true, $model->save());

        $model = new SeoModel(['model_name' => Post::class, 'model_id' => 1]);
        $this->assertEquals(false, $model->validate());
    }
}
