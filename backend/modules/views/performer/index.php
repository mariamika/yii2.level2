<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\PerformerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Performers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performer-index">

    <p>
        <?= Html::a(Yii::t('app','Create Performer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if (Yii::$app->user->can('deleteTask')){
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
            ['attribute' => 'name',
                'label' => Yii::t('app','Name'),
                'value' => 'name'],
            ['attribute' => 'email',
                'label' => 'Email',
                'value' => 'email'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => $actionColumns],
        ],
    ]);
    Pjax::end();?>
</div>
