<?php
use yii\bootstrap\Html;
use yii\grid\GridView;
/* @var $model_tasks yii\data\ActiveDataProvider
 * @var $model_end_tasks yii\data\ActiveDataProvider
 * @var $model_overdue_tasks yii\data\ActiveDataProvider
 */
?>

<div class="admin-default-index">
    <?php echo Html::a('Projects',['/admin/project'],['class' => 'btn btn-primary'])?>

    <?php echo Html::a('Tasks',['/admin/task'],['class' => 'btn btn-primary']);?>

    <?php echo Html::a('Performers',['/admin/performer'],['class' => 'btn btn-primary'])?>
</div>

<div style="padding: 1px 5px 1px 15px;
            margin-top: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;"
     class="p-3 mb-2 bg-primary text-white">
    <h3>Полный список задач</h3>
</div>
<div style="border-left: #0d6aad 1px solid;
            border-right: #0d6aad 1px solid;
            border-bottom: #0d6aad 1px solid;">
    <?= GridView::widget(['dataProvider' => $model_tasks,
        'columns' => [['attribute' => 'taskName',
            'label' => Yii::t('app','Task Name'),
            'value' => 'taskName'],
            ['attribute' => 'statusTask',
                'filter' => [0 => 'Close',
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
                'filter' => [1 => 'Высокий приоритет',
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
            ['attribute' => 'performer',
                'label' => Yii::t('app','Performer'),
                'value' => 'performer.name'],
            ['attribute' => 'project',
                'label' => Yii::t('app','Project'),
                'value' => 'project.projectName']
        ],
    ]); ?>
</div>

<div style="padding: 1px 5px 1px 15px;
            margin-top: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background-color: #994d53;
            color: #FFFFFF">
    <h3>Просроченные задачи</h3>
</div>
<div style="border-left: #994d53 1px solid;
            border-right: #994d53 1px solid;
            border-bottom: #994d53 1px solid;">
    <?= GridView::widget(['dataProvider' => $model_overdue_tasks,
        'columns' => [['attribute' => 'taskName',
            'label' => Yii::t('app','Task Name'),
            'value' => 'taskName'],
            ['attribute' => 'statusTask',
                'filter' => [0 => 'Close',
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
                'filter' => [1 => 'Высокий приоритет',
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
            ['attribute' => 'performer',
                'label' => Yii::t('app','Performer'),
                'value' => 'performer.name'],
            ['attribute' => 'project',
                'label' => Yii::t('app','Project'),
                'value' => 'project.projectName']
        ],
    ]); ?>
</div>



<div style="padding: 1px 5px 1px 15px;
            margin-top: 50px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background-color: #f39c12">
    <h3>Завершенные задачи</h3>
</div>
<div style="border-left: #f39c12 1px solid;
            border-right: #f39c12 1px solid;
            border-bottom: #f39c12 1px solid;">
    <?= GridView::widget(['dataProvider' => $model_end_tasks,
        'columns' => [['attribute' => 'taskName',
            'label' => Yii::t('app','Task Name'),
            'value' => 'taskName'],
            ['attribute' => 'statusTask',
                'filter' => [0 => 'Close',
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
                'filter' => [1 => 'Высокий приоритет',
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
            ['attribute' => 'performer',
                'label' => Yii::t('app','Performer'),
                'value' => 'performer.name'],
            ['attribute' => 'project',
                'label' => Yii::t('app','Project'),
                'value' => 'project.projectName']
        ],
    ]); ?>
</div>
