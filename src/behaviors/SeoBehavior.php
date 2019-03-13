<?php

namespace bastardijke\yii\seo\behaviors;

use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\web\Controller;

use bastardijke\yii\seo\models\Seo;

class SeoBehavior extends Behavior
{

    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param ActionEvent $event
     * @return bool
     * @throws MethodNotAllowedHttpException when the request method is not allowed.
     */
    public function beforeAction($event)
    {

        $seo = Seo::findByControllerAndAction($this->owner->id, $this->owner->action->id);

        $this->owner->view->title = $seo->meta_title;

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $seo->meta_description,
        ], 'description');

        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $seo->meta_keywords,
        ], 'keywords');

        \Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => $seo->index.','.$seo->follow,
        ], 'robots');

        //\Yii::$app->view->registerMetaTag(Yii::$app->params['pageDefaultAuthor'],"default_author");

        return true;
    }
}
