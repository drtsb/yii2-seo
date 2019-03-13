<?php

namespace bastardijke\yii\seo\widgets;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

use bastardijke\yii\seo\SeoAsset;

class SeoWidget extends \yii\base\Widget
{

    public $form = null;
    public $model = null;
    public $title = "SEO";
    
    public function init()
    {

        parent::init();

        if (is_null($this->form) || is_null($this->model) ) {
            throw new InvalidConfigException( 'Required options "form" and "model" are missed.' );
        }

        SeoAsset::register($this->getView());
    }

    public function run()
    {

        $html[] = Html::beginTag('fieldset', ['class'=>'well',]);

        $html[] = Html::tag('legend', $this->title, ['class'=>'seo-legend',]);

        $html[] = $this->form->field($this->model, 'meta_title')->textInput(['maxlength'=>true]);

        $html[] = $this->form->field($this->model, 'meta_description')->textInput(['maxlength'=>true]);

        $html[] = $this->form->field($this->model, 'meta_keywords')->textInput(['maxlength'=>true]);

        $html[] = Html::endTag('fieldset');

        return implode("\n", $html);

    }

}