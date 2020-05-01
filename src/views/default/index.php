<?php

use drtsb\yii\seo\models\SeoStaticSearch;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */
/* @var $searchModel SeoStaticSearch */

$this->title = Yii::t('seo', 'SEO');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('seo', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            //'id',
            //'created_at:datetime',
            //'updated_at',
            'controller',
            'action',
            [
                'attribute' => 'meta_title',
                'value' => static function ($model) {
                    return empty($model->meta_title) ? null : StringHelper::truncate($model->meta_title, 25);
                },
            ],
            [
                'attribute' => 'meta_description',
                'value' => static function ($model) {
                    return empty($model->meta_description) ? null
                        : StringHelper::truncate($model->meta_description, 25);
                },
            ],
            [
                'attribute' => 'meta_keywords',
                'value' => static function ($model) {
                    return empty($model->meta_keywords) ? null : StringHelper::truncate($model->meta_keywords, 25);
                },
            ],
            'meta_noindex:boolean',
            'meta_nofollow:boolean',

            ['class' => ActionColumn::class],
        ],
    ]) ?>
</div>
