<?php

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = Yii::t('app','Update Project: ') . $model->id_project;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_project, 'url' => ['view', 'id' => $model->id_project]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-update">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
