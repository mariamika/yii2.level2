<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

    Pjax::begin(['enablePushState' => false]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'projectName',
                'format' => 'raw',
                'value' => function ($data) {
                  return Html::a($data->projectName,['project/view','id' => $data->id_project]);
                },
            ],
            ['attribute' => 'project_status',
                'filter' => [
                    0 => 'Close',
                    1 => 'Active'
                ],
                'label' => Yii::t('app','Status'),
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column){
                    $active = $model->{$column->attribute} === 1;
                    return $active ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Close</span>';
                }
            ],
            'description',
            ['attribute' => 'responsible',
                'label' => Yii::t('app','Responsible'),
                'value' => 'user.username'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    Pjax::end();
    ?>
</div>
