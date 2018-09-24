<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        /*'css/estilo.css',
        'css/calendario/default.css',
        'css/calendario/jquery.click-calendario-1.0.css',
        'css/calendario-modal.css',*/
    ];
    public $js = [
        'js/main.js',
        //'js/calendario/jquery.click-calendario-1.0-min.js',
        //'js/calendario/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
