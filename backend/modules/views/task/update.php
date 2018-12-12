<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */
/* @var $projects \common\models\Project */

$this->title = Yii::t('app','Update Task: ') . $model->id_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_task, 'url' => ['view', 'id' => $model->id_task]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="tasks-update">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'model_pic' => $model_pic,
        'projects' =>$projects,
    ]) ?>

</div>
