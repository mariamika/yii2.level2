<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','My Tasks');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="tasks-index" style="background-color: #D6EAFF; border-radius: 20px; padding: 20px;">

    <h1><?= Html::encode($this->title) ?></h1>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'view',
            'viewParams' => [
                    'hideBreadcrumbs' => true
            ]
        ]); ?>

</div>