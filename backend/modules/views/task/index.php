<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            ['attribute' => 'description',
                'label' => Yii::t('app','Description'),
                //TODO не работает установка ширины столбца ...
                //'contentOptions' => ['style' => 'width: 100px !important;'],
                'value' => 'description'],
            ['attribute' => 'priority',
                'label' => Yii::t('app','Priority'),
                'value' => 'priority'],
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
            ['class' => 'yii\grid\ActionColumn',
                'template' => $actionColumns],
        ],
    ]);
    ?>
</div>
