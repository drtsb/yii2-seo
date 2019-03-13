<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bastardijke\yii\seo\Module;

/* @var $this yii\web\View */
/* @var $model common\components\seo\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'controller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_noindex')->checkBox() ?>

    <?= $form->field($model, 'meta_nofollow')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('seo', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
