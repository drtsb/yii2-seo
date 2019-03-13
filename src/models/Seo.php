<?php

namespace bastardijke\yii\seo\models;

use yii\behaviors\TimestampBehavior;
use yii\base\ErrorException;

use bastardijke\yii\seo\Module;

/**
 * This is the model class for table "seo_pages".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $controller
 * @property string $action
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $meta_noindex
 * @property integer $meta_nofollow
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['controller', 'action'], 'required'],
            [['created_at', 'updated_at', 'meta_noindex', 'meta_nofollow', ], 'integer'],
            [['controller', 'action', 'meta_title', 'meta_description', 'meta_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('seo', 'ID'),
            'created_at' => Module::t('seo', 'Created At'),
            'updated_at' => Module::t('seo', 'Updated At'),
            'controller' => Module::t('seo', 'Controller'),
            'action' => Module::t('seo', 'Action'),
            'meta_title' => Module::t('seo', 'Meta Title'),
            'meta_description' => Module::t('seo', 'Meta Description'),
            'meta_keywords' => Module::t('seo', 'Meta Keywords'),
            'meta_noindex' => Module::t('seo', 'NOINDEX'),
            'meta_nofollow' => Module::t('seo', 'NOFOLLOW'),
        ];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->controller . '/' . $this->action;
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->meta_noindex ? 'noindex' : 'index';
    }

    /**
     * @return string
     */
    public function getFollow()
    {
        return $this->meta_nofollow ? 'nofollow' : 'follow';
    }

    /**
     * @return 
     */
    public function findByControllerAndAction( $controller , $action )
    {
        $seo = self::find()
            ->where(['controller' => [$controller, '*'], 'action' => [$action, '*'], ])
            ->orderBy(['controller' => SORT_DESC, 'action' => SORT_DESC, ])
            ->one();

        if (!$seo) {
            throw new ErrorException("No default SEO values found.", 1);
        }

        return $seo;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}