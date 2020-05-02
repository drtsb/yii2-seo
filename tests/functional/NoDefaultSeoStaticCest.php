<?php

namespace drtsb\yii\seo\tests\functional;

use drtsb\yii\seo\tests\FunctionalTester;
use yii\base\ErrorException;

class NoDefaultSeoStaticCest
{
    /**
     * @expectedException ErrorException
     * @param FunctionalTester $I
     */
    public function checkNoDefaultSeoStatic(FunctionalTester $I)
    {
        $I->expectThrowable(
            new ErrorException('No default SEO values found.', 1),
            static function () use ($I) {
                $I->amOnRoute('site/index');
            }
        );
    }
}
