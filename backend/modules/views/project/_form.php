<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="project-form">
    <?php \yii\widgets\Pjax::begin(['id' => 'new_project'])?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'projectName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_status')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php \yii\widgets\Pjax::end();?>
</div>
