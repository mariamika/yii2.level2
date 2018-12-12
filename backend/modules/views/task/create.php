<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */
/* @var $projects \common\models\Project */
/* @var $items */

$this->title = Yii::t('app','Create Tasks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_pic' => $model_pic,
        'items' => $items,
        'projects' =>$projects,
    ]) ?>

</div>
