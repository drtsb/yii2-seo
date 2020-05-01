<?php

namespace drtsb\yii\seo;

use Yii;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{

    /**
     * @var null|array The roles which have access to module controllers,
     * eg. ['admin']. If set to `null`, there is no accessFilter applied
     */
    public $accessRoles;

    /**
     * @var bool|array Pagination settings
     */
    public $pagination = false;

    public function init()
    {
        parent::init();
        self::registerTranslations();
    }

    public static function registerTranslations()
    {
        Yii::$app->i18n->translations['seo'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/drtsb/yii2-seo/src/messages',
        ];
    }
}
