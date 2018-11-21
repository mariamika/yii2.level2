<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Tasks');?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Create Tasks'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            ['attribute' => 'id_task',
                'label' => Yii::t('app','ID Task'),
                'value' => 'id_task'],
            ['attribute' => 'taskName',
                'label' => Yii::t('app','Task Name'),
                'value' => 'taskName'],
            ['attribute' => 'priority',
                'label' => Yii::t('app','Priority'),
                'value' => 'priority'],
            ['attribute' => 'dateCreate',
                'label' => Yii::t('app','Date Create'),
                'value' => 'dateCreate'],
            ['attribute' => 'dateDeadline',
                'label' => Yii::t('app','Date Deadline'),
                'value' => 'dateDeadline'],
            ['attribute' => 'performer',
                'label' => Yii::t('app','Performer'),
                'value' => 'performer.name'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => $actionColumns],
        ],
    ]);
    ?>
</div>
