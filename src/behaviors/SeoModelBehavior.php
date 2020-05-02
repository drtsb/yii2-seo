<?php

namespace drtsb\yii\seo\behaviors;

use Exception;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

use drtsb\yii\seo\models\SeoModel;
use drtsb\yii\seo\widgets\SeoFieldsWidget;
use yii\web\Application;

/**
 *
 * @property SeoModel $seoAttributesFromClosure
 * @property SeoModel $newSeo
 * @property SeoModel|ActiveQuery $seo
 */
class SeoModelBehavior extends Behavior
{
    /**
     * @var callable|null
     */
    public $dataClosure = null;

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        if (!is_callable($this->dataClosure) && !is_null($this->dataClosure)) {
            throw new InvalidConfigException('SeoModelBehavior::$dataClosure is not callable or null.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveSeo',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveSeo',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteSeo',
        ];
    }

    /**
     * @param $event
     * @return void
     */
    public function saveSeo($event)
    {

        $seo = $this->setSeoAttributesFromClosure($this->owner->seo);
        if (Yii::$app instanceof Application) {
            $seo->load(Yii::$app->request->post());
        }
        $seo->save();
    }

    /**
     * @param $event
     * @return void
     */
    public function deleteSeo($event)
    {
        if ($this->owner->seo) {
            $this->owner->seo->delete();
        }
    }

    /**
     * @return ActiveQuery | SeoModel
     */
    public function getSeo()
    {
        $query = SeoModel::find()->where(
            ['model_name' => get_class($this->owner), 'model_id' => $this->owner->primaryKey]
        );
        if ($query->one() !== null) {
            return $query;
        }

        return $this->getNewSeo();
    }

    /**
     * Renders a widget.
     * @param $form
     * @return string the rendering result of the widget.
     * @throws Exception
     */
    public function seoFields($form)
    {
        return SeoFieldsWidget::widget(['form'=>$form, 'model'=>$this->owner->seo]);
    }

    /**
     * @return SeoModel
     */
    protected function getNewSeo()
    {
        $seo = new SeoModel(['model_name'=>get_class($this->owner), 'model_id' => $this->owner->primaryKey]);

        return $this->setSeoAttributesFromClosure($seo);
    }

    /**
     * @var $seo SeoModel
     * @return SeoModel
     */
    protected function setSeoAttributesFromClosure(SeoModel $seo)
    {
        if (!is_null($this->dataClosure)) {
            $seo->setAttributes(call_user_func($this->dataClosure, $this->owner));
        }
        return $seo;
    }
}
