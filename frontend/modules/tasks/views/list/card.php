<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Tasks */
/* @var $model_pic \common\models\Files */
/* @var $model_comment \common\models\Comment */

\frontend\assets\SocketAsset::register($this);

$this->title = Yii::t('app','Task number ') . $model->id_task;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','List Tasks'), 'url' => ['/tasks']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'priority',
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
                        echo Html::img(\yii\helpers\Url::to($model_pic->address_small_picture),['alt' => 'Upload Image for Task']);
                    } else {
                        foreach ($model_pic as $item){
                            echo Html::img(\yii\helpers\Url::to($item->address_small_picture),[
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
