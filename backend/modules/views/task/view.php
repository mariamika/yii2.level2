<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */
/* @var $model_comment \common\models\Comment */

\backend\assets\SocketAsset::register($this);

$this->title = Yii::t('app','Task number ') . $model->id_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

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
            ['attribute' => 'statusTask',
                'label' => Yii::t('app','Status'),
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->statusTask ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Close</span>';
                },
            ],
            'description',
            ['attribute' => 'priority',
                'label' => Yii::t('app','Priority'),
                'format' => 'raw',
                'value' => function ($data){
                    $arr_search = [
                        1 => 'Высокий приоритет',
                        2 => 'Средний приоритет',
                        3 => 'Низкий приоритет',
                        4 => 'Необязательно'
                    ];

                    if (array_key_exists($data->priority,$arr_search)){
                        return '<span class="label label-primary">' . $arr_search[$data->priority] . '</span>';
                    }
                }
            ],
            'project.projectName:text:Project',
            'dateCreate',
            'dateDeadline',
            'performer.name:text:Performer',
            'user.username:text:Creator'
        ],
    ]) ?>

    <table>
        <tr>
            <td style="width: 50%">
                <div>
                    <form action="#" name="chat-form" id="chat-form">
                        <label>
                            Введите комментарий
                            <input type="text" name="message">
                            <input type="submit">
                            <input type="hidden" name="task_id" value="<?= $model->id_task?>">
                        </label>
                    </form>
                </div>
                <hr>
                <div id="root-chat" style="height: 200px; overflow: auto">
                    <div>
                        <?php if (is_object($model_comment)){
                            echo Html::tag('div', Html::encode($model_comment->message));
                        } else {
                            foreach ($model_comment as $comment){
                                echo Html::tag('div', Html::encode($comment->message));
                            }
                        }?>
                    </div>
                </div>
            </td>
            <td style="width: 50%">
                <div>
                    <?php if (is_object($model_pic)){
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
            </td>
        </tr>
        <tr></tr>
    </table>
</div>
