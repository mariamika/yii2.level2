<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Project */

$this->title = Yii::t('app','Project #') . $model->id_project;
if (!$hideBreadcrumbs){
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app','Projects'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="project-view">
    <div style="margin: 50px; width: 400px; background-color: #FAFAFA; padding: 8px;">
        <a href="/projects/project/card?id=<?= $model->id_project?>"><h3><?= Html::encode($this->title) ?></h3></a>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
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
</div>
