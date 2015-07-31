<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class XzpAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/default/css/main.min.css',
    ];
    public $js = [
        'themes/default/js/html5shiv.js',
        'themes/default/js/selectivizr-min.js',
        'themes/default/js/jquery.1.11.1.js',
        'themes/default/js/main.min.js'
    ];
    public $depends = [

    ];
}
