<?php

namespace drtsb\yii\seo\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\InvalidConfigException;

class MetaTagsWidget extends \yii\base\Widget
{

    public $view = null;
    public $model = null;
    
    public function init()
    {
        parent::init();
        if (is_null($this->view) || is_null($this->model) ) {
            throw new InvalidConfigException( 'Required options "form" and "model" are missed.' );
        }
    }

    public function run()
    {
        if ($seo = $this->model->seo) {
            $this->view->title = $seo->meta_title ?: $this->model->title;

            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $seo->meta_description,
            ], 'description');

            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $seo->meta_keywords,
            ], 'keywords');

            $this->view->registerMetaTag([
                'name' => 'robots',
                'content' => $seo->robots,
            ], 'robots');

            $this->view->registerLinkTag([
                'rel' => 'canonical',
                'href' => Url::to($seo->rel_canonical, true)
            ], 'canonical');
        }
    }

}