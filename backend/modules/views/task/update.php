<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */

$this->title = Yii::t('app','Update Task: ') . $model->id_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_task, 'url' => ['view', 'id' => $model->id_task]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        'model_pic' => $model_pic,
    ]) ?>

</div>
