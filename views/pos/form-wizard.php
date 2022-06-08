<?php
use yii\helpers\Url;

$reg = $_GET['reg'] ?? null;
$rm = $_GET['rm'] ?? null;


?>

<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "resume" ? 'active' : null ?>" href="<?= Url::to(['/pos/resume', 'reg' => $reg, 'rm' => $rm,]) ?>"><i class="fas fa-notes-medical mr-2"></i>Resume</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "obat" ? 'active' : null ?>" href="<?= Url::to(['/pos/obat', 'reg' => $reg, 'rm' => $rm,]) ?>"><i class="fas fa-pills mr-2"></i>Obat</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "obat-racikan" ? 'active' : null ?>" href="<?= Url::to(['/pos/obat-racikan', 'reg' => $reg, 'rm' => $rm,]) ?>"><i class="fas fa-pills mr-2"></i>Obat Racikan</a>
</li>
<li class="nav-item">
    <a class="nav-link <?= $this->context->action->id == "penunjang" ? 'active' : null ?>" href="<?= Url::to(['/pos/penunjang', 'reg' => $reg, 'rm' => $rm,]) ?>"><i class="fas fa-life-ring mr-2"></i>Penunjang</a>
</li>
<li class="nav-item ml-auto">
    <a class="nav-link nav-checkout <?= $this->context->action->id == "check-out" ? 'active' : null ?>" href="<?= Url::to(['/pos/check-out', 'reg' => $reg, 'rm' => $rm,]) ?>"><i class="fas fa-cash-register mr-2"></i>Checkout</a>
</li>