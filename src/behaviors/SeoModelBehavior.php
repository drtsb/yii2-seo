<?php

namespace drtsb\yii\seo\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

use drtsb\yii\seo\models\SeoModel;
use drtsb\yii\seo\widgets\SeoFieldsWidget;

class SeoModelBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveSeo',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveSeo',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteSeo',
        ];
    }

    public function saveSeo($event)
    {
        if (!$seo = $this->owner->seo) {
            $seo = new SeoModel(['model_name'=>get_class($this->owner), 'model_id' => $this->owner->primaryKey]);
        }
        $seo->load(Yii::$app->request->post());
        $seo->save();
    }

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
        return new SeoModel(['model_name'=>get_class($this->owner), 'model_id' => $this->owner->primaryKey]);
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