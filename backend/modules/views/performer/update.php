<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Performer */

$this->title = Yii::t('app','Update Performer: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Performers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->index]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="performer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
