<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\LoginAsset;
use app\components\Menu;
use app\widgets\Alert;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

LoginAsset::register($this);
// \hail812\adminlte3\assets\PluginAsset::register($this)->add([
//     'chart.js',
//     'icheck-bootstrap',
//     'pace',
//     'popper',
//     'overlayScrollbars',
//     'sweetalert2',
//     'toastr',
// ]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Montserrat:wght@300;500;700&family=Open+Sans:wght@300;500;700&family=Plus+Jakarta+Sans:wght@300;500;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style> 
        .wrapper-page {
            margin: 5% auto;
            position: relative;
            width: 320px !important;
            height: 520px !important;
        }
    </style>
    <script>
        const baseUrl = '<?= YII_ENV_DEV ? Url::base('http') : Yii::$app->homeUrl ?>/';
        let controller = '<?= Yii::$app->controller->id ?>';
        const moduleName = '<?= Yii::$app->controller->module->id ?>';
    </script>
    <?php $this->head() ?>
</head>

<body class="fixed-left" id="app">
    <?php $this->beginBody() ?>

    <!-- Begin page -->
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <?= $content ?>
    <!-- END wrapper -->
    <?php

    Modal::begin([
        'id' => 'myModal',
        'size' => Modal::SIZE_DEFAULT,
        'options' => [
            'tabindex' => false,
            'data-backdrop' => 'static',
        ]
    ]);
    Modal::end();
    ?>
    <?php $this->endBody() ?>
</body>

<script>
    yii.confirm = function(message, okCallback, cancelCallback) {
        Swal.fire({
            title: 'Perhatian!',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                okCallback()
                console.log(okCallback);

                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    };
</script>

</html>
<?php $this->endPage() ?>