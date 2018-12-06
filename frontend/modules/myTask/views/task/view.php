<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */

$this->title = Yii::t('app','Task number ') . $model->id_task;

if (!$hideBreadcrumbs){
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="tasks-view">
    <div style="width: 100%; display: flex; justify-content: space-around; flex-wrap: wrap; align-items: center; align-content: center">
        <div style="margin: 20px; width: 400px">
            <a href="/myTask/task/card?id=<?= $model->id_task?>"><h3><?= Html::encode($this->title) ?></h3></a>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'taskName',
                    ['attribute' => 'statusTask',
                        'label' => Yii::t('app','Status'),
                        'format' => 'raw',
                        'value' => function ($data) {
                            return $data->statusTask ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Close</span>';
                        },
                    ],
                    'priority',
                    'dateCreate',
                    'dateDeadline',
                    'performer.name:text:Performer',
                ],
            ]) ?>
        </div>
    </div>
</div>
