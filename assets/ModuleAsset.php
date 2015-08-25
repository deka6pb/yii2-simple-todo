<?php
namespace deka6pb\simpleTodo\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle {
    /**
     * @inheritdoc
     */
    public $sourcePath = '@deka6pb/simpleTodo/assets';

    public $css = [
        'css/main.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}