<?php

use yii\helpers\Url;

?>
<ul>
    <li class="text-muted menu-title">Navigation</li>

    <li>
        <a href="<?= Url::to(['/site/index']) ?>" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
    </li>

    <li>
        <a href="<?= Url::to(['/pasien/index']) ?>" class="waves-effect"><i class="fa fa-users"></i> <span> Data Pasien </span> </a>
    </li>
    <li class="text-muted menu-title">Data User</li>

    <li>
        <a href="<?= Url::to(['/pegawai/index']) ?>" class="waves-effect"><i class="fas fa-users"></i> <span> Data Pegawai </span> </a>
    </li>
    <li>
        <a href="#" class="waves-effect"><i class="fa fa-list"></i> <span> Data User </span> </a>
    </li>

    <li class="text-muted menu-title">Master Klinik</li>

    <li>
        <a href="<?= Url::to(['/poli/index']) ?>" class="waves-effect"><i class="fas fa-poll-h "></i> <span> Master Poli </span> </a>
    </li>
    <li>
        <a href="<?= Url::to(['/pekerjaan/index']) ?>" class="waves-effect"><i class="fa fa-suitcase"></i> <span> Master Pekerjaan </span> </a>
    </li>
    <li>
        <a href="<?= Url::to(['/merk/index']) ?>" class="waves-effect"><i class="fa fa-list"></i> <span> Master Merk </span> </a>
        <a href="<?= Url::to(['/satuan/index']) ?>" class="waves-effect"><i class="fa fa-list"></i> <span> Master Satuan </span> </a>
        <a href="<?= Url::to(['/kategori/index']) ?>" class="waves-effect"><i class="fa fa-list-ul"></i> <span> Master Ketegori Item </span> </a>
        <a href="<?= Url::to(['/item-lab/index']) ?>" class="waves-effect"><i class="fa fa-thermometer-0 "></i> <span> Item Lab </span> </a>
    </li>
    
    

</ul>