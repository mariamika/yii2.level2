<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Tasks');?>
<div class="tasks-index">

    <p><?= Html::a(Yii::t('app','Create Tasks'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php
    if (Yii::$app->user->can('deleteTask')){
        $actionColumns = '{view} {update} {delete}';
    } else {
        $actionColumns = '{view}';
    }

    Pjax::begin(['enablePushState' => false]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'taskName',
                'label' => Yii::t('app','Task Name'),
                'value' => 'taskName'],
            ['attribute' => 'statusTask',
                'filter' => [
                    0 => 'Close',
                    1 => 'Active'
                ],
                'label' => Yii::t('app','Status'),
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === 1;
                    return $active ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Close</span>';
                },
            ],
            ['attribute' => 'priority',
                'filter' => [
                    1 => 'Высокий приоритет',
                    2 => 'Средний приоритет',
                    3 => 'Низкий приоритет',
                    4 => 'Необязательно к испольнению'
                ],
                'label' => Yii::t('app','Priority'),
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    $arr_search = [
                        1 => 'Высокий приоритет',
                        2 => 'Средний приоритет',
                        3 => 'Низкий приоритет',
                        4 => 'Необязательно'
                    ];

                    if (array_key_exists($model->{$column->attribute},$arr_search)){
                        return '<span class="label label-primary">' . $arr_search[$model->{$column->attribute}] . '</span>';
                    }
                }
            ],
            ['attribute' => 'dateCreate',
                'label' => Yii::t('app','Date Create'),
                'format' => ['date', 'dd/MM/yyyy'],
                'value' => 'dateCreate'],
            ['attribute' => 'dateDeadline',
                'label' => Yii::t('app','Date Deadline'),
                'format' => ['date', 'dd/MM/yyyy'],
                'value' => 'dateDeadline'],
            ['attribute' => 'performer',
                'label' => Yii::t('app','Performer'),
                'value' => 'performer.name'],
            ['attribute' => 'creatorTask',
                'label' => Yii::t('app','Creator'),
                'value' => 'user.username'],
            ['attribute' => 'project',
                'label' => Yii::t('app','Project'),
                'value' => 'project.projectName'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => $actionColumns],
        ],
    ]);
    Pjax::end();
    ?>
</div>
