<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
    ]) ?>

</div>
