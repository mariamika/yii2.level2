<?php
$script = <<<JS
    setInterval(function() {
      $("#btn-refresh").click();
    }, 20);
JS;

\yii\widgets\Pjax::begin();?>
<div class="message-container">
    <?php
    echo \yii\helpers\Html::a('Refresh', ['telegram/receive'],['id' => 'btn-refresh', 'class' => 'btn btn-success']);
    foreach ($messages as $message):?>
        <div>
            <strong><?=$message['username']?>: </strong>
            <?=$message['text'];?>
        </div>
    <?php endforeach;?>
</div>
<?php \yii\widgets\Pjax::end();?>