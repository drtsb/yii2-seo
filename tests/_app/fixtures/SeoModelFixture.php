<?php
namespace app\fixtures;

use yii\test\ActiveFixture;

class SeoModelFixture extends ActiveFixture
{
    public $modelClass = 'drtsb\yii\seo\models\SeoModel';
    public $depends = [
    	'app\fixtures\PostFixture',
    ];
}