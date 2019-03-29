<?php

use app\fixtures\SeoModelFixture;
use app\fixtures\SeoStaticFixture;
use app\fixtures\PostFixture;

class SeoModelCest
{

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'seo-model' => [
                'class' => SeoModelFixture::class,
                'dataFile' => codecept_data_dir() . 'seo_model.php',
            ],
            'seo-static' => [
                'class' => SeoStaticFixture::class,
                'dataFile' => codecept_data_dir() . 'seo_static.php',
            ],
            'posts' => [
                'class' => PostFixture::class,
                'dataFile' => codecept_data_dir() . 'post.php'
            ],
        ];
    }

    public function checkSitePostWithSeoModel(FunctionalTester $I)
    {
        $I->amOnRoute('site/post', ['id' => 1]);
        $I->seeInTitle('Post 1 Meta Title');
        $I->seeInSource('<meta name="description" content="Post 1 Meta Description">');
        $I->seeInSource('<meta name="keywords" content="Post 1 Meta Keywords">');
        $I->seeInSource('<meta name="robots" content="index,follow">');
        $I->seeInSource('<link href="http://somepost.com" rel="canonical">');
    }

    public function checkSitePostWithoutSeoModel(FunctionalTester $I)
    {
        $I->amOnRoute('site/post', ['id' => 2]);
        $I->wantTo('see empty seo values');
        $I->seeInTitle('Post 2');
        $I->seeInSource('<meta name="description">');
        $I->seeInSource('<meta name="keywords">');
        $I->seeInSource('<meta name="robots" content="index,follow">');
    }

}