<?php

namespace app\models;

use Yii;
use drtsb\yii\seo\models\SeoModel;
use drtsb\yii\seo\behaviors\SeoModelBehavior;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 */
class Article extends PureArticle
{

    public function behaviors()
    {
        return [
            'seo' => [
                'class' => SeoModelBehavior::class,
                'dataClosure' => static function ($model) {
                    return [
                        'meta_title' => $model->title . ' Title',
                        'meta_description' => $model->title . ' Description',
                        'meta_keywords' => $model->title . ' Keywords',
                        'meta_noindex' => true,
                        'meta_nofollow' => true,
                    ];
                },
            ],
        ];
    }
}
