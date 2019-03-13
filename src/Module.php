<?php

namespace bastardijke\yii\seo;

use Yii;

class Module extends \yii\base\Module
{

    /**
     * @var null|array The roles which have access to module controllers, eg. ['admin']. If set to `null`, there is no accessFilter applied
     */
    public $accessRoles = null;

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['yii2-seo/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/bastardijke/yii2-seo/src/messages',
            'fileMap' => [
                'yii2-seo/seo' => 'seo.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('yii2-seo/' . $category, $message, $params, $language);
    }

}