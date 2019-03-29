<?php

namespace drtsb\yii\seo\models;

use Yii;
use drtsb\yii\seo\Module;

/**
 * This is the base Seo models class.
 *
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $meta_noindex
 * @property integer $meta_nofollow
 */
abstract class Seo extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty(\Yii::$app->i18n->translations['seo'])) {
            Module::registerTranslations();
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_noindex', 'meta_nofollow', ], 'boolean'],
            [['meta_title', 'meta_description', 'meta_keywords', 'rel_canonical'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'meta_title' => Yii::t('seo', 'Meta Title'),
            'meta_description' => Yii::t('seo', 'Meta Description'),
            'meta_keywords' => Yii::t('seo', 'Meta Keywords'),
            'meta_noindex' => Yii::t('seo', 'NOINDEX'),
            'meta_nofollow' => Yii::t('seo', 'NOFOLLOW'),
            'rel_canonical' => Yii::t('seo', 'Canonical Link'),
        ];
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
     * @return string
     */
    public function getRobots()
    {
        return $this->index.','.$this->follow;
    }

}