<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // "theme/assets/css/bootstrap.min.css",
        // "theme/assets/plugins/morris/morris.css",
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
        "theme/assets/css/icons.css",
        "theme/assets/css/style.css",
        "theme/assets/plugins/select2/css/select2.min.css",
        // 'theme/assets/plugins/select2/css/select2.min.css',
        "css/app.css",

    ];
    public $js = [
        // "theme/assets/js/modernizr.min.js",

        // "theme/assets/js/jquery.min.js",
        "theme/assets/js/popper.min.js",
        "theme/assets/js/bootstrap.min.js",
        "theme/assets/js/detect.js",
        "theme/assets/js/fastclick.js",
        "theme/assets/js/jquery.blockUI.js",
        "theme/assets/js/waves.js",
        "theme/assets/js/jquery.nicescroll.js",
        "theme/assets/js/jquery.slimscroll.js",
        "theme/assets/js/jquery.scrollTo.min.js",
        "theme/assets/plugins/raphael/raphael-min.js",
        
        // // "theme/assets/plugins/morris/morris.min.js",
        // "theme/assets/pages/jquery.morris.init.js",
        "theme/assets/js/jquery.core.js",
        "theme/assets/plugins/select2/js/select2.min.js",
        "theme/assets/js/jquery.app.js",
        'plugins/typeahead.js/typeahead.bundle.min.js',
        'plugins/hotkeys.js/hotkeys.min.js',
        // 'https://unpkg.com/hotkeys-js/dist/hotkeys.min.js',
        'js/site.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}
