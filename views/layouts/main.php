<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Menu;
use app\modules\rbac\components\Helper;
use app\widgets\Alert;
use yii\bootstrap4\Modal;
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
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Montserrat:wght@300;500;700&family=Open+Sans:wght@300;500;700&family=Plus+Jakarta+Sans:wght@300;500;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 18.5px !important;
            padding-left: 5px !important;
        } */

        html,
        body {
            background-color: #fafafa !important;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        #sidebar-menu>ul>li>a {
            color: #435966;
            display: block;
            padding: 10px 20px !important;
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

        .navbar-default {
            background-color: #ffffff !important;
            border-radius: 0px;
            border: none;
            border-top-color: currentcolor;
            border-top-style: none;
            border-top-width: medium;
            border-top: 3px solid #71b6f9;
            margin-bottom: 0px;
            padding: 0px 10px;
            box-shadow: 0px 0px 0.1px grey !important;
        }

        .topbar .topbar-left {
            background: #ffffff;
            border-top: 3px solid #71b6f9;
            float: left;
            text-align: center;
            height: 73px;
            position: relative;
            width: 250px;
            z-index: 1;
            box-shadow: 0px 0.8px 0px #ccc !important;

        }

        .side-menu {
            top: 70px;
            width: 250px;
            z-index: 10;
            background: #fff;
            bottom: 0;
            margin-top: 0;
            padding-bottom: 30px;
            position: fixed;
            -webkit-box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.06), 0 1px 0 0 rgba(0, 0, 0, 0.02);
            box-shadow: 0px 5px 6px 6px #ccc !important;
        }

        .card {

            border-radius: 5px !important;
            border: none;
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
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?= Url::to(['/']) ?>" class="logo"><span>Pak<span>ning</span></span><i class="mdi mdi-layers"></i></a>
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
                    <h5><a href="#"><?= Yii::$app->user->identity->nama_lengkap ?></a> </h5>
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
                        ['label' => 'Dashboard', 'icon' => 'desktop', 'url' => ['/site/index']],
                        ['label' => 'Data Pasien', 'icon' => 'user', 'url' => ['/pasien/index']],
                        ['label' => 'Data Transaksi', 'header' => true],
                        ['label' => 'Transaksi', 'icon' => 'poll-h', 'url' => ['/pos/obat']],
                        ['label' => 'Master', 'header' => true],
                        ['label' => 'Data Dokter', 'icon' => 'users', 'url' => ['/dokter/index']],
                        ['label' => 'Data Obat', 'icon' => 'list', 'url' => ['/barang/index']],
                        ['label' => 'Data Satuan', 'icon' => 'list', 'url' => ['/satuan/index']],
                        ['label' => 'Data Pengguna', 'icon' => 'users', 'url' => ['/pengguna/index']],
                        ['label' => 'Master Pembayaran', 'header' => true],
                        ['label' => 'Cara Bayar', 'icon' => 'list', 'url' => ['/satuan/index']],
                        ['label' => 'Session', 'header' => true],
                        ['label' => 'Route', 'icon' => 'list', 'url' => ['/admin/route']],
                        ['label' => 'Permission', 'icon' => 'list', 'url' => ['/admin/permission']],
                        ['label' => 'Role', 'icon' => 'list', 'url' => ['/admin/role']],
                        ['label' => 'Assignment', 'icon' => 'list', 'url' => ['/admin/assignment']],
                        ['label' => 'Session', 'header' => true],
                        ['label' => 'Logout', 'icon' => 'home', 'url' => ['/site/logout']],
                    ];
                    // $menuItems = Helper::filter($menuItems);

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
        <div class="content-page" style="margin-top:10px;margin-bottom: 20px !important ;">
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
            <a href="<?= Url::to(['pasien/cari-pasien-modal']) ?>" data-title="Cari Pasien" id="openModal" data-toggle="modal" data-target="#myModal"></a>
            <?= $this->render('right-menu') ?>
        </div>
        <!-- /Right-bar -->

    </div>
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
<script>
    hotkeys.filter = ({
        target
    }) => {
        return true
        // console.log(target.tagName);
        // return target.tagName === 'INPUT' || target.tagName === 'DIV' || target.tagName === 'BODY';
        // return !(target.tagName === 'INPUT' && target.type !== 'radio') ;
    }


    hotkeys('f1,f2', function(event, handler) {
        event.preventDefault();
        switch (handler.key) {
            case 'f1':
                $('#openModal').click()
                break;
            case 'f2':
                window.location.href = baseUrl + 'pasien/create';
                // $('#openModal').click()
                break;
            default:
                alert(event);
        }
    });
</script>
<script>
    $('#myModal').on('show.bs.modal', function(event) {
        // event.preventDefault();
        let button = $(event.relatedTarget)
        let modal = $(this)
        let title = button.data('title')
        let header = `${title}
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>`
        let href = button.attr('href')
        modal.find('.modal-header').html(header)
        // modal.find('.modal-body').html(bodyLoad)
        $.get(href)
            .done(function(data) {
                modal.find('.modal-body').html(data)
            });
    })
</script>

</html>
<?php $this->endPage() ?>