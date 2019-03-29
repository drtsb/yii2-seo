<?php

namespace drtsb\yii\seo\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\ErrorException;

/**
 * This is the model class for table "seo_static".
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
class SeoStatic extends Seo
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_static';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['controller', 'action'], 'required'],
                [['created_at', 'updated_at', ], 'integer'],
                [['controller', 'action', ], 'string', 'max' => 255],
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
                'id' => Yii::t('seo', 'ID'),
                'created_at' => Yii::t('seo', 'Created At'),
                'updated_at' => Yii::t('seo', 'Updated At'),
                'controller' => Yii::t('seo', 'Controller'),
                'action' => Yii::t('seo', 'Action'),
            ]
        );
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->controller . '/' . $this->action;
    }

    /**
     * @param string $controller
     * @param string $action
     * @throws ErrorException if no model found
     * @return SeoStatic
     */
    public static function findByControllerAndAction($controller, $action)
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