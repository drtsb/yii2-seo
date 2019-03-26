<?php

use yii\helpers\Html;
use drtsb\yii\seo\widgets\MetaTagsWidget;

/* @var $this yii\web\View */

$this->title = $model->title;

MetaTagsWidget::widget(['view' => $this, 'model' => $model]);
?>
<div class="site-post">

    <div class="jumbotron">
        <h1><?= Html::encode($model->title) ?></h1>
    </div>

    <div class="body-content">
  
    </div>
</div>
