<?php

$time = time();

return [
    'seo-model-post-1' => [
        'model_name' => 'app\models\Post',
        'model_id' => 1,
        'meta_title' => 'Post 1 Meta Title',
        'meta_description' => 'Post 1 Meta Description',
        'meta_keywords' => 'Post 1 Meta Keywords',
        'rel_canonical' => 'https://post1.com',
        'dont_use_empty' => false,
    ],
    'seo-model-post-3' => [
        'model_name' => 'app\models\Post',
        'model_id' => 3,
        'meta_title' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'rel_canonical' => null,
        'dont_use_empty' => true,
    ],    
];