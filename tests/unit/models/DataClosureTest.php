<?php
use app\models\PureArticle;

class DataClosureTest extends \Codeception\Test\Unit
{
    public function testFullSetOfSeoAttributes()
    {
        $model = new PureArticle(['title' => 'Some Article']);

        $model->attachBehavior('seo', [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
            'dataClosure' => function($model) {
                return [
                    'meta_title' => $model->title . ' Title',
                    'meta_description' => $model->title . ' Description',
                    'meta_keywords' => $model->title . ' Keywords',
                    'meta_noindex' => true,
                    'meta_nofollow' => true,
                ];
            },
        ]);

        $model->save();

        $this->assertEquals($model->seo->meta_title, 'Some Article Title');
        $this->assertEquals($model->seo->meta_description, 'Some Article Description');
        $this->assertEquals($model->seo->meta_keywords, 'Some Article Keywords');
        $this->assertEquals($model->seo->meta_noindex, true);
        $this->assertEquals($model->seo->meta_nofollow, true);
    }

    public function testEmptySetOfSeoAttributes()
    {
        $model = new PureArticle();

        $model->attachBehavior('seo', [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
            'dataClosure' => function($model) {
                return [];
            }
        ]);

        $model->save();

        $this->assertEquals($model->seo->meta_title, null);
        $this->assertEquals($model->seo->meta_description, null);
        $this->assertEquals($model->seo->meta_keywords, null);
        $this->assertEquals($model->seo->meta_noindex, false);
        $this->assertEquals($model->seo->meta_nofollow, false);
    }

    public function testUpdatedBehaviorClosure()
    {
        $model = new PureArticle();

        $model->attachBehavior('seo', [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
            'dataClosure' => function($model) {
                return [
                    'meta_title' => 'Original Title',
                    'meta_description' => 'Original Description',
                    'meta_keywords' => 'Original Keywords',
                ];
            },
        ]);

        $model->save();

        $model->detachBehavior('seo');

        $model->attachBehavior('seo', [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
            'dataClosure' => function($model) {
                return [
                    'meta_title' => 'Updated Title',
                    'meta_description' => 'Updated Description',
                    'meta_keywords' => 'Updated Keywords',
                    'meta_noindex' => true,
                    'meta_nofollow' => true,
                ];
            },
        ]);

        $model->save();

        $this->assertEquals($model->seo->meta_title, 'Updated Title');
        $this->assertEquals($model->seo->meta_description, 'Updated Description');
        $this->assertEquals($model->seo->meta_keywords, 'Updated Keywords');
        $this->assertEquals($model->seo->meta_noindex, true);
        $this->assertEquals($model->seo->meta_nofollow, true);
    }

    /**
     * @expectedException yii\base\InvalidConfigException
     */
    public function testInvalidDataClosure()
    {
        $model = new PureArticle();

        $model->attachBehavior('seo', [
            'class' => 'drtsb\yii\seo\behaviors\SeoModelBehavior',
            'dataClosure' => 'something',
        ]);
    }
}