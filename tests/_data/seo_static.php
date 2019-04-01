<?php

$time = time();

return [
    'seo-site-index' => [
        'created_at' => $time,
        'updated_at' => $time,
        'controller' => 'site',
        'action' => 'index',
        'meta_title' => 'Site Index Meta Title',
        'meta_description' => 'Site Index Meta Description',
        'meta_keywords' => 'Site Index Meta Keywords',
        'rel_canonical' => 'site/index',
    ],
    'seo-site-any-action' => [
        'created_at' => $time,
        'updated_at' => $time,
        'controller' => 'site',
        'action' => '*',
        'meta_title' => 'Site Any Action Meta Title',
        'meta_description' => 'Site Any Action Meta Description',
        'meta_keywords' => 'Site Any Action Meta Keywords',
        'meta_noindex' => true,
        'rel_canonical' => 'https://site.any',
    ],
    'seo-any-controller-index' => [
        'created_at' => $time,
        'updated_at' => $time,
        'controller' => '*',
        'action' => 'index',
        'meta_title' => 'Any Controller Index Meta Title',
        'meta_description' => 'Any Controller Index Meta Description',
        'meta_keywords' => 'Any Controller Index Meta Keywords',
        'meta_nofollow' => true,
    ],
    'seo-any-controller-any-action' => [
        'created_at' => $time,
        'updated_at' => $time,
        'controller' => '*',
        'action' => '*',
        'meta_title' => 'Any Controller Any Action Meta Title',
        'meta_description' => 'Any Controller Any Action Meta Description',
        'meta_keywords' => 'Any Controller Any Action Meta Keywords',
        'meta_noindex' => true,
        'meta_nofollow' => true,
        'rel_canonical' => 'https://any.any',
    ],
];