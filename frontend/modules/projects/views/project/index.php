<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Projects');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="project-index" style="background-color: #CCCCFF; border-radius: 20px; padding: 20px;">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'layout' => "{items}\n{summary}\n{pager}",
        'options' => [
            'tag' => 'div',
            'style' => [
                'with' => '100%',
                'display' => 'flex',
                'justify-content' => 'space-around',
                'flex-wrap' => 'wrap',
                'align-items' => 'center',
                'align-content' => 'center'
            ]
        ],
        'viewParams' => [
            'hideBreadcrumbs' => true
        ]
    ]); ?>

</div>