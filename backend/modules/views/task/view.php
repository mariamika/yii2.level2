<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */

\backend\assets\SocketAsset::register($this);

$this->title = Yii::t('app','Task number ') . $model->id_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->can('deleteTask')){
            echo Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id_task], ['class' => 'btn btn-primary']);
            echo ' ';
            echo Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id_task], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_task',
            'taskName',
            'priority',
            'dateCreate',
            'dateDeadline',
            'performer.name:text:performer',
        ],
    ]) ?>

    <div>
        <? if (is_object($model_pic)){
            echo Html::img(Url::to($model_pic->address_small_picture),['alt' => 'Upload Image for Task']);
        } else {
            foreach ($model_pic as $item){
                echo Html::img(Url::to($item->address_small_picture),[
                    'alt' => 'Upload Image for Task',
                    'style' =>[
                        'margin' => '10px',
                        'width' => '150px',
                    ]]);
            }
        }?>
    </div>

    <form action="#" name="chat-form" id="chat-form">
        <label>
            Введите сообщение
            <input type="text" name="message">
            <input type="submit">
        </label>
    </form>
    <hr>
    <div id="root-chat"></div>
</div>
