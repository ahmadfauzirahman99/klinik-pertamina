<?php

use yii\helpers\Url;
?>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "update" ? 'active' : null ?>" href="<?= Url::to(['/pasien/update', 'id' => $model->id_patient]) ?>"><i class="fa fa-user mr-2"></i>Biodata Pasien</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "pendaftaran" ? 'active' : null ?>" href="<?= Url::to(['/pasien/pendaftaran', 'id' => $model->id_patient]) ?>"><i class="fa fa-plus mr-2"></i>Pendaftaran Pasien</a>
</li>