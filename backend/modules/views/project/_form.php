<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'projectName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_status')->textInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'responsible')->dropDownList($items, ['prompt' => '-Choose a Responsible']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
