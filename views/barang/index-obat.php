<?php

use app\assets\DatatableAsset;
use yii\web\View;

$this->title = 'Index Obat';

DatatableAsset::register($this);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-striped  dt-responsive nowrap" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Obat</th>
                                <th>Nama Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama Obat</th>
                                <th>Nama Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->registerJs($this->render('index-obat.js'), View::POS_END) ?>