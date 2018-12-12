<?php
/* @var $this yii\web\View */
/* @var $model \common\models\Performer */

$this->title = Yii::t('app','Create Performer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Performers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
