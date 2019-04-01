<?php
use drtsb\yii\seo\models\SeoModel;

class SeoModelTest extends \Codeception\Test\Unit
{
    public function testUniqueModel()
    {
        $model = new SeoModel(['model_name' => 'app\models\Post', 'model_id' => 1]);
        $this->assertEquals($model->save(), true);

        $model = new SeoModel(['model_name' => 'app\models\Post', 'model_id' => 1]);
        $this->assertEquals($model->validate(), false);
    }

}