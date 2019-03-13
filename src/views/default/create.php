<?php

use yii\helpers\Html;

use bastardijke\yii\seo\Module;

/* @var $this yii\web\View */
/* @var $model common\components\seo\models\Seo */

$this->title = Module::t('seo', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('seo', 'SEO'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
