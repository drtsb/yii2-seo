<?php

namespace drtsb\yii\seo\tests\unit;

use app\models\PureArticle;
use Codeception\Test\Unit;
use drtsb\yii\seo\behaviors\SeoModelBehavior;
use yii\base\InvalidConfigException;

class DataClosureTest extends Unit
{
    public function testFullSetOfSeoAttributes()
    {
        $model = new PureArticle(['title' => 'Some Article']);

        $model->attachBehavior('seo', [
            'class' => SeoModelBehavior::class,
            'dataClosure' => static function ($model) {
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

        $this->assertEquals('Some Article Title', $model->seo->meta_title);
        $this->assertEquals('Some Article Description', $model->seo->meta_description);
        $this->assertEquals('Some Article Keywords', $model->seo->meta_keywords);
        $this->assertEquals(true, $model->seo->meta_noindex);
        $this->assertEquals(true, $model->seo->meta_nofollow);
    }

    public function testEmptySetOfSeoAttributes()
    {
        $model = new PureArticle();

        $model->attachBehavior('seo', [
            'class' => SeoModelBehavior::class,
            'dataClosure' => static function () {
                return [];
            }
        ]);

        $model->save();

        $this->assertEquals(null, $model->seo->meta_title);
        $this->assertEquals(null, $model->seo->meta_description);
        $this->assertEquals(null, $model->seo->meta_keywords);
        $this->assertEquals(false, $model->seo->meta_noindex);
        $this->assertEquals(false, $model->seo->meta_nofollow);
    }

    public function testUpdatedBehaviorClosure()
    {
        $model = new PureArticle();

        $model->attachBehavior('seo', [
            'class' => SeoModelBehavior::class,
            'dataClosure' => static function () {
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
            'class' => SeoModelBehavior::class,
            'dataClosure' => static function () {
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

        $this->assertEquals('Updated Title', $model->seo->meta_title);
        $this->assertEquals('Updated Description', $model->seo->meta_description);
        $this->assertEquals('Updated Keywords', $model->seo->meta_keywords);
        $this->assertEquals(true, $model->seo->meta_noindex);
        $this->assertEquals(true, $model->seo->meta_nofollow);
    }

    public function testInvalidDataClosure()
    {
        $model = new PureArticle();

        $this->expectException(InvalidConfigException::class);
        $model->attachBehavior('seo', [
            'class' => SeoModelBehavior::class,
            'dataClosure' => 'something',
        ]);
    }
}
