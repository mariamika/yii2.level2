<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class SocketAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/client.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}