<?php

use drtsb\yii\seo\models\SeoStatic;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model SeoStatic */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('seo', 'SEO'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="seo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('seo', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('seo', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('seo', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at:datetime',
            'updated_at:datetime',
            'controller',
            'action',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'rel_canonical:url',
            'meta_noindex:boolean',
            'meta_nofollow:boolean',
        ],
    ]) ?>

</div>
