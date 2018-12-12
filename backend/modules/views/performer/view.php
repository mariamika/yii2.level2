<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Performer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Performers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performer-view">

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->index], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->index], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'index',
            'name',
            'email',
        ],
    ]) ?>

</div>
