<?php

namespace drtsb\yii\seo\models;

/**
 * This is the model class for table "seo_model".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $meta_noindex
 * @property integer $meta_nofollow
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
                [['model_name', 'model_id'], 'unique', 'targetAttribute' => ['model_name', 'model_id']],
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