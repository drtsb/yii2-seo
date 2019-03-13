<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\grid\GridView;

use bastardijke\yii\seo\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('seo', 'SEO');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('seo', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'created_at:datetime',
            //'updated_at',
            'controller',
            'action',
            [
                'attribute' => 'meta_title',
                'value' => function ( $model ) {
                    return empty( $model->meta_title ) ? null : StringHelper::truncate( $model->meta_title , 25 );
                },
            ],
            [
                'attribute' => 'meta_description',
                'value' => function ( $model ) {
                    return empty( $model->meta_description ) ? null : StringHelper::truncate( $model->meta_description , 25 );
                },
            ],
            [
                'attribute' => 'meta_keywords',
                'value' => function ( $model ) {
                    return empty( $model->meta_keywords ) ? null : StringHelper::truncate( $model->meta_keywords , 25 );
                },
            ],
            'meta_noindex:boolean',
            'meta_nofollow:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
