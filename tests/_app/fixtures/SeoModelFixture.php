<?php

namespace app\fixtures;

use yii\test\ActiveFixture;
use drtsb\yii\seo\models\SeoModel;

class SeoModelFixture extends ActiveFixture
{
    public $modelClass = SeoModel::class;
    public $depends = [
        PostFixture::class,
    ];
}
