<?php

namespace app\commands;

use app\models\Post;
use yii\console\Controller;
use yii\console\ExitCode;

class PostController extends Controller
{
    public function actionCreate()
    {
        $post = new Post(['title' => 'Test Post']);
        $post->save();
        return ExitCode::OK;
    }
}
