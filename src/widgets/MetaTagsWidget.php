<?php

namespace drtsb\yii\seo\widgets;

use Yii;
use yii\helpers\Html;
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
        if ($this->model->seo) {
            $this->view->title = $this->model->seo->meta_title ?: $this->model->title;

            $this->view->registerMetaTag([
                'name' => 'description',
                'content' => $this->model->seo->meta_description,
            ], 'description');

            $this->view->registerMetaTag([
                'name' => 'keywords',
                'content' => $this->model->seo->meta_keywords,
            ], 'keywords');

            $this->view->registerMetaTag([
                'name' => 'robots',
                'content' => $this->model->seo->index.','.$this->model->seo->follow,
            ], 'robots');
        }
    }

}