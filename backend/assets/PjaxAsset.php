<?php
namespace backend\assets;
use yii\web\AssetBundle;

class PjaxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/pjax.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}