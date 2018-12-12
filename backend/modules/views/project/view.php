<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = Yii::t('app','Project ') . $model->id_project;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <p>
        <?= Html::a('Add Task', ['task/create'], ['class' => 'btn btn-success'])?>
        <?= Html::a('Update', ['update', 'id' => $model->id_project], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_project], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_project',
            'projectName',
            ['attribute' => 'project_status',
                'label' => Yii::t('app','Status'),
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->project_status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Close</span>';
                },
            ],
            'description',
            'user.username:text:Responsible',
        ],
    ]) ?>

</div>
