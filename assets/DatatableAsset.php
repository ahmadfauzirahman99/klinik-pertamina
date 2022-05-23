<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatatableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $css = [
        "theme/assets/plugins/datatables/dataTables.bootstrap4.min.css",
        "theme/assets/plugins/datatables/buttons.bootstrap4.min.css",
        "theme/assets/plugins/datatables/responsive.bootstrap4.min.css",
        "theme/assets/plugins/datatables/select.bootstrap4.min.css",

    ];
    public $js = [
        "theme/assets/plugins/datatables/jquery.dataTables.min.js",
        "theme/assets/plugins/datatables/dataTables.bootstrap4.min.js"
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}
