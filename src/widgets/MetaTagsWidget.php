<?php

namespace drtsb\yii\seo\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Url;

class MetaTagsWidget extends Widget
{
    public $view;
    public $model;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (is_null($this->view) || is_null($this->model)) {
            throw new InvalidConfigException('Required options "form" and "model" are missed.');
        }
    }

    public function run()
    {
        if ($seo = $this->model->seo) {
            if (!($seo->dont_use_empty && empty($seo->meta_title))) {
                $this->view->title = $seo->meta_title;
            }

            if (!($seo->dont_use_empty && empty($seo->meta_description))) {
                $this->view->registerMetaTag([
                    'name' => 'description',
                    'content' => $seo->meta_description,
                ], 'description');
            }

            if (!($seo->dont_use_empty && empty($seo->meta_keywords))) {
                $this->view->registerMetaTag([
                    'name' => 'keywords',
                    'content' => $seo->meta_keywords,
                ], 'keywords');
            }

            $this->view->registerMetaTag([
                'name' => 'robots',
                'content' => $seo->robots,
            ], 'robots');

            if (!($seo->dont_use_empty && empty($seo->rel_canonical))) {
                $this->view->registerLinkTag([
                    'rel' => 'canonical',
                    'href' => Url::to($seo->rel_canonical, true)
                ], 'canonical');
            }
        }
    }
}
