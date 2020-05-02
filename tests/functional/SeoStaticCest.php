<?php

namespace drtsb\yii\seo\tests\functional;

use drtsb\yii\seo\tests\FunctionalTester;
use yii\helpers\Url;

use app\fixtures\SeoStaticFixture;

class SeoStaticCest
{
    /**
     * @return array
     * phpcs:disable
     */
    public function _fixtures()
    {
        /** phpcs:enable */
        return [
            'seo-static' => [
                'class' => SeoStaticFixture::class,
                'dataFile' => codecept_data_dir() . 'seo_static.php',
            ],
        ];
    }

    public function checkSiteIndex(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->seeInTitle('Site Index Meta Title');
        $I->seeInSource('<meta name="description" content="Site Index Meta Description">');
        $I->seeInSource('<meta name="keywords" content="Site Index Meta Keywords">');
        $I->seeInSource('<meta name="robots" content="index,follow">');
        $I->seeInSource('<link href="'.Url::to('site/index', true).'" rel="canonical">');
    }

    public function checkSiteAnyAction(FunctionalTester $I)
    {
        $I->amOnRoute('site/some-action');
        $I->seeInTitle('Site Any Action Meta Title');
        $I->seeInSource('<meta name="description" content="Site Any Action Meta Description">');
        $I->seeInSource('<meta name="keywords" content="Site Any Action Meta Keywords">');
        $I->seeInSource('<meta name="robots" content="noindex,follow">');
    }

    public function checkSomeIndex(FunctionalTester $I)
    {
        $I->amOnRoute('some/index');
        $I->seeInTitle('Any Controller Index Meta Title');
        $I->seeInSource('<meta name="description" content="Any Controller Index Meta Description">');
        $I->seeInSource('<meta name="keywords" content="Any Controller Index Meta Keywords">');
        $I->seeInSource('<meta name="robots" content="index,nofollow">');
    }

    public function checkSomeAction(FunctionalTester $I)
    {
        $I->amOnRoute('some/action');
        $I->seeInTitle('Any Controller Any Action Meta Title');
        $I->seeInSource('<meta name="description" content="Any Controller Any Action Meta Description">');
        $I->seeInSource('<meta name="keywords" content="Any Controller Any Action Meta Keywords">');
        $I->seeInSource('<meta name="robots" content="noindex,nofollow">');
        $I->seeInSource('<link href="https://any.any" rel="canonical">');
    }
}
