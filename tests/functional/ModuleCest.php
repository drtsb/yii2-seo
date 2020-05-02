<?php

namespace drtsb\yii\seo\tests\functional;

use app\fixtures\SeoStaticFixture;
use drtsb\yii\seo\models\SeoStatic;
use drtsb\yii\seo\tests\FunctionalTester;
use Yii;

class ModuleCest
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
                'dataFile' => codecept_data_dir() . 'seo_static.php'
            ],
        ];
    }

    public function checkIndex(FunctionalTester $I)
    {
        $I->amOnRoute('seo/default');
        $I->see(Yii::t('seo', 'SEO'), 'h1');
    }

    public function checkSeoModelCreated(FunctionalTester $I)
    {
        $I->amOnRoute('seo/default/create');
        $I->see(Yii::t('seo', 'Create'), 'h1');

        $I->fillField(['name' => 'SeoStatic[controller]'], 'some');
        $I->fillField(['name' => 'SeoStatic[action]'], 'page');
        $I->fillField(['name' => 'SeoStatic[meta_title]'], 'Some Page Meta Title');
        $I->fillField(['name' => 'SeoStatic[meta_description]'], 'Some Page Meta Description');
        $I->fillField(['name' => 'SeoStatic[meta_keywords]'], 'Some Page Meta Keywords');
        $I->checkOption('#seostatic-meta_noindex');
        $I->checkOption('#seostatic-meta_nofollow');
        $I->click(Yii::t('seo', 'Save'));

        $record = $I->grabRecord(SeoStatic::class, ['controller' => 'some', 'action' => 'page']);
        $I->see($record->title, 'h1');
        $I->assertEquals('Some Page Meta Title', $record->meta_title);
        $I->assertEquals('Some Page Meta Description', $record->meta_description);
        $I->assertEquals('Some Page Meta Keywords', $record->meta_keywords);
        $I->assertEquals(true, $record->meta_noindex);
        $I->assertEquals(true, $record->meta_nofollow);
    }
}
