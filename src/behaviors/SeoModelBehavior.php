<?php

namespace drtsb\yii\seo\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

use drtsb\yii\seo\models\SeoModel;
use drtsb\yii\seo\widgets\SeoFieldsWidget;

class SeoModelBehavior extends Behavior
{

    /**
     * @var callable | null
     */
    public $dataClosure = null;

    /**
     * {@inheritdoc}
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
     * @return void
     */
    public function saveSeo($event)
    {
        $seo = $this->setSeoAttributesFromClosure($this->owner->seo);
        $seo->load(Yii::$app->request->post());
        $seo->save();
    }

    /**
     * @return void
     */
    public function deleteSeo($event)
    {
        if ($this->owner->seo) {
            $this->owner->seo->delete();
        }
    }

    /**
     * @return \yii\db\ActiveQuery | drtsb\yii\seo\models\SeoModel
     */
    public function getSeo()
    {
        $query = SeoModel::find()->where(['model_name' => get_class($this->owner), 'model_id' => $this->owner->primaryKey]);
        if ($query->one() !== null) { return $query; }       
        return $this->getNewSeo();
    }

    /**
     * @return drtsb\yii\seo\models\SeoModel
     */
    private function getNewSeo()
    {
        $seo = new SeoModel(['model_name'=>get_class($this->owner), 'model_id' => $this->owner->primaryKey]);

        return $this->setSeoAttributesFromClosure($seo);
    }

    /**
     * @var $seo drtsb\yii\seo\models\SeoModel
     * @return drtsb\yii\seo\models\SeoModel
     */
    private function setSeoAttributesFromClosure(SeoModel $seo)
    {
        if (!is_null($this->dataClosure)){
            $seo->setAttributes(call_user_func($this->dataClosure, $this->owner));
        }
        return $seo;
    }

    /**
     * Renders a widget.
     * @return string the rendering result of the widget.
     */
    public function seoFields($form)
    {
        return SeoFieldsWidget::widget(['form'=>$form, 'model'=>$this->owner->seo]);
    }

}