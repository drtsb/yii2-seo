<?php

namespace app\fixtures;

use yii\test\ActiveFixture;
use app\models\Post;

class PostFixture extends ActiveFixture
{
    public $modelClass = Post::class;
}
