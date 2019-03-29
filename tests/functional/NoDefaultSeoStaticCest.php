<?php

use app\fixtures\SeoStaticFixture;

class NoDefaultSeoStaticCest
{

    public function checkNoDefaultSeoStatic(FunctionalTester $I)
    {
        $I->expectException(new yii\base\ErrorException('No default SEO values found.', 1), function() use ($I) {
            $I->amOnRoute('site/index');
        });
    }

}
