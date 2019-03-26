<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

//$this->title = 'yii2-seo test';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>yii2-seo test</h1>
    </div>

    <div class="body-content">
    
    <?php foreach ($posts as $post) {
        echo Html::a(Html::tag('h2', $post->title), ['site/post', 'id' => $post->primaryKey]);
    }?>
    
    </div>
</div>
