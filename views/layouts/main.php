<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Menu;
use app\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add([
    'chart.js',
    'icheck-bootstrap',
    'pace',
    'popper',
    'overlayScrollbars',
    'sweetalert2',
    'toastr',
]);
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        /* .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 18.5px !important;
            padding-left: 5px !important;
        } */

        #sidebar-menu>ul>li>a {
            color: #435966;
            display: block;
            padding: 5px 20px !important;
            margin: 4px 0px;
            background-color: #ffffff;
            border-left: 3px solid transparent;
        }

        #sidebar-menu,
        #sidebar-menu ul,
        #sidebar-menu li,
        #sidebar-menu a {
            border: 0;
            font-weight: normal;
            line-height: 0 !important;
            list-style: none;
            margin: 0;
            padding: 0;
            position: relative;
            text-decoration: none;
        }
    </style>
    <script>
        const baseUrl = '<?= Yii::$app->request->baseUrl ?>';
        let controller = '<?= Yii::$app->controller->id ?>';
        const moduleName = '<?= Yii::$app->controller->module->id ?>';
    </script>
    <?php $this->head() ?>
</head>

<body class="fixed-left">
    <?php $this->beginBody() ?>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?= Url::to(['/']) ?>" class="logo"><span>A<span>dmin</span></span><i class="mdi mdi-layers"></i></a>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">

                    <!-- Page title -->
                    <ul class="nav navbar-nav list-inline navbar-left">
                        <li class="list-inline-item">
                            <button class="button-menu-mobile open-left">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="page-title"><?= $this->title ?></h4>
                        </li>
                    </ul>

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">
                            <?= $this->render('navbar') ?>
                        </ul>
                    </nav>
                </div><!-- end container -->
            </div><!-- end navbar -->
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">

                <!-- User -->
                <div class="user-box">
                    <div class="user-img">
                        <img src="<?= Url::to('@web/img/s.png') ?>" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail img-responsive">
                        <div class="user-status offline"><i class="mdi mdi-adjust"></i></div>
                    </div>
                    <h5><a href="#">Mat Helme</a> </h5>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="mdi mdi-settings"></i>
                            </a>
                        </li>

                        <li class="list-inline-item">
                            <a href="#" class="text-custom">
                                <i class="mdi mdi-power"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End User -->

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <?php
                    $menuItems =   [

                        ['label' => 'Informasi', 'header' => true],
                        ['label' => 'Dashboard', 'icon' => 'info', 'url' => ['/site/index']],
                        ['label' => 'Data Pasien', 'icon' => 'user', 'url' => ['/pasien/index']],
                        ['label' => 'Data Transaksi', 'header' => true],
                        ['label' => 'Transaksi', 'icon' => 'poll-h', 'url' => ['/pos/tindakan']],
                        ['label' => 'Maste', 'header' => true],
                        ['label' => 'Data Dokter', 'icon' => 'users', 'url' => ['/dokter/index']],
                        ['label' => 'Data Obat', 'icon' => 'list', 'url' => ['/barang/index']],
                        ['label' => 'Data Satuan', 'icon' => 'list', 'url' => ['/satuan/index']],


                    ];
                    echo Menu::widget([
                        'items' => $menuItems   
                    ]);
                    ?>
                    <div class="clearfix"></div>
                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>

        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <?= Alert::widget() ?>
                    </div>
                    <?= $content ?>
                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
                <?= date('Y') ?> © SYAFIRA APPS
            </footer>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <?= $this->render('right-menu') ?>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

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