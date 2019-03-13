<?php

use yii\helpers\Html;

use bastardijke\yii\seo\Module;

/* @var $this yii\web\View */
/* @var $model common\components\seo\models\Seo */

$this->title = Module::t('seo', 'Update: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('seo', 'SEO'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('seo', 'Update');
?>
<div class="seo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
