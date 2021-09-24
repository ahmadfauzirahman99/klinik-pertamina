<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="row">
        <div class="col-xl-8">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
                </div>

                <h4 class="header-title m-t-0 m-b-30">Pendapatana</h4>

                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <h5 style="color: #ff8acc;"><i class="fa fa-circle m-r-5"></i>Series A</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5 style="color: #5b69bc;"><i class="fa fa-circle m-r-5"></i>Series B</h5>
                        </li>
                    </ul>
                </div>
                <div id="morris-line-example" class="morris-chart" style="height: 300px;"></div>

            </div>
        </div><!-- end col-->

        <div class="col-xl-4">
            <div class="card-box">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                    </div>
                </div>

                <h4 class="header-title m-t-0 m-b-30">Pendapatan</h4>
                <div class="row">
                    <div class="col-xl-12 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                </div>
                            </div>

                            <h4 class="header-title mt-0 m-b-30">Total Penjualan Hari Ini</h4>

                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <span class="badge badge-success badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                    <h2 class="mb-0"> Rp, 10000000 </h2>
                                    <p class="text-muted m-b-25">Pendapatan Hari Ini</p>
                                </div>
                                <div class="progress progress-bar-success-alt progress-sm mb-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                        <span class="sr-only">77% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6">
                        <div class="card-box">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                </div>
                            </div>

                            <h4 class="header-title mt-0 m-b-30">Total Penjualan Minggu Ini</h4>

                            <div class="widget-box-2">
                                <div class="widget-detail-2">
                                    <span class="badge badge-success badge-pill pull-left m-t-20">32% <i class="mdi mdi-trending-up"></i> </span>
                                    <h2 class="mb-0"> Rp, 10000000 </h2>
                                    <p class="text-muted m-b-25">Pendapatan Hari Ini</p>
                                </div>
                                <div class="progress progress-bar-success-alt progress-sm mb-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;">
                                        <span class="sr-only">77% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end col-->

        </div>
        <!-- end row -->


    </div>
</div>