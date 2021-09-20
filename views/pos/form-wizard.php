<?php

use yii\helpers\Url;
?>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "obat" ? 'active' : null ?>" href="<?= Url::to(['/pos/obat', 'id' => '']) ?>"><i class="fas fa-pills mr-2"></i>Obat</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "penunjang" ? 'active' : null ?>" href="<?= Url::to(['/pos/penunjang', 'id' => '']) ?>"><i class="fas fa-x-ray mr-2"></i>Penunjang</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "Check Out" ? 'active' : null ?>" href="<?= Url::to(['/pos/check-out']) ?>"><i class="fas fa-cash-register mr-2"></i>Checkout</a>
</li>