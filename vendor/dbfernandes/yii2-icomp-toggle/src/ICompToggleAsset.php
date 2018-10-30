<?php

namespace dbfernandes\icomp;

use yii\web\AssetBundle;

/**
 * Class ICompToggleWidgetAsset
 * @package backend\assets
 */
class ICompToggleAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-toggle';

    public $css = [
        'css/bootstrap2-toggle.css',
    ];

    public $js = [
        'js/bootstrap2-toggle.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
