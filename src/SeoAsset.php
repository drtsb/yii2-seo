<?php

namespace drtsb\yii\seo;

use yii\web\AssetBundle;

class SeoAsset extends AssetBundle
{
    public $css = [
        'css/seo.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
