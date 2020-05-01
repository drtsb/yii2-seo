<?php

namespace drtsb\yii\seo\tests\functional;

use app\fixtures\PostFixture;
use app\models\Post;
use drtsb\yii\seo\tests\FunctionalTester;

class PostCest
{
    public function checkPostIndex(FunctionalTester $I)
    {
        $I->haveFixtures([
            'posts' => [
                'class' => PostFixture::class,
                'dataFile' => codecept_data_dir() . 'post.php'
            ],
        ]);

        $I->amOnRoute('post/index');
        $I->see('Posts', 'h1');
    }

    public function checkSeoModelCreated(FunctionalTester $I)
    {
        $I->amOnRoute('post/create');
        $I->see('Create', 'h1');

        $I->fillField(['name' => 'Post[title]'], 'Some Post');
        $I->fillField(['name' => 'SeoModel[meta_title]'], 'Some Post Meta Title');
        $I->fillField(['name' => 'SeoModel[meta_description]'], 'Some Post Meta Description');
        $I->fillField(['name' => 'SeoModel[meta_keywords]'], 'Some Post Meta Keywords');
        $I->fillField(['name' => 'SeoModel[rel_canonical]'], 'http://google.com');
        $I->checkOption('#seomodel-meta_noindex');
        $I->checkOption('#seomodel-meta_nofollow');
        $I->click('Save');

        $I->see('Some Post', 'h1');
        $I->see('http://google.com', 'a');
        $post = $I->grabRecord(Post::class, ['id' => 1]);
        $I->assertEquals('Some Post', $post->title);
        $I->assertEquals('Some Post Meta Title', $post->seo->meta_title);
    }
}
