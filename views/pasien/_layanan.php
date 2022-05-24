<?php

use app\models\Poli;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($layanan, 'jenis_layanan')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Poli::find()->all(), 'id_poli', 'nama_poli'),
    'options' => ['placeholder' => 'Poli Pelayanan'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>