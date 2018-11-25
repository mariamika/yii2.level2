<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\PerformerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Performers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Create Performer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if (Yii::$app->user->can('deleteTask')){
        $actionColumns = '{view} {update} {delete}';
    } else {
        $actionColumns = '{view}';
    }
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'name',
                'label' => Yii::t('app','Name'),
                'value' => 'name'],
            ['attribute' => 'email',
                'label' => 'Email',
                'value' => 'email'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => $actionColumns],
        ],
    ]); ?>
</div>
