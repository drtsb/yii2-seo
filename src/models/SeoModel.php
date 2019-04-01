<?php

namespace drtsb\yii\seo\models;

use Yii;

/**
 * This is the model class for table "seo_model".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $rel_canonical
 * @property integer $meta_noindex
 * @property integer $meta_nofollow
 * @property integer $dont_use_empty
 */
class SeoModel extends Seo
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['model_name', 'model_id'], 'required'],
                [['model_id'], 'integer'],
                [['model_name'], 'string', 'max' => 255],
                [['dont_use_empty'], 'boolean'],
                [['dont_use_empty'], 'default', 'value' => false],
                [['model_name', 'model_id'], 'unique', 'targetAttribute' => ['model_name', 'model_id']],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge( 
            parent::attributeLabels(),
            [
                'dont_use_empty' => Yii::t('seo', 'Don\'t use empty'),
            ]
        );
    }

    /**
     * @return array
     */
    public function seoRules()
    {
        return parent::rules();
    }

}