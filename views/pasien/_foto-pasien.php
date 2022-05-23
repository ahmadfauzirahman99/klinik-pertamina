<?php

use kartik\file\FileInput;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-sm-6">
        <?=
        $form->field($model, 'foto', [
            'labelOptions' => ['class' => 'col-sm-12 col-form-label-sm'],
            'template' => '
                                        {label}
                                        <div class="col-sm-12">
                                            {input}
                                            {hint}{error}
                                        </div>
                                    ',
        ])->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'initialPreview' => [
                    $model->foto ? Url::to('@web/img/pasien/' . $model->foto) : null
                ],
                'initialPreviewAsData' => true,
                'initialCaption' => $model->foto,
                'initialPreviewConfig' => [
                    [
                        'caption' => $model->foto,
                        'showRemove' => true,
                        'url' => Url::to(['pasien/hapus-foto-diri-ktp']), // server delete action 
                        'key' => $model->id_patient,
                        'extra' => [
                            'jenis_foto' => 'foto',
                            'nama_file' => $model->foto
                        ]
                    ],
                ],
                'overwriteInitial' => true,
                'maxFileSize' => 2800,
                'deleteUrl' => Url::to(['/site/file-upload']),
            ]
        ])->label('Foto Diri')
        ?>
    </div>
    <div class="col-lg-6">
        <?=
        $form->field($model, 'foto_ktp', [
            'labelOptions' => ['class' => 'col-sm-12 col-form-label-sm'],
            'template' => '
                                        {label}
                                        <div class="col-sm-12">
                                            {input}
                                            {hint}{error}
                                        </div>
                                    ',
        ])->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'initialPreview' => [
                    $model->foto_ktp ? Url::to('@web/img/pasien/' . $model->foto_ktp) : null
                ],
                'initialPreviewAsData' => true,
                'initialCaption' => $model->foto_ktp,
                'initialPreviewConfig' => [
                    [
                        'caption' => $model->foto_ktp,
                        'showRemove' => true,
                        'url' => Url::to(['pasien/hapus-foto-diri-ktp']), // server delete action 
                        'key' => $model->id_patient,
                        'extra' => [
                            'jenis_foto' => 'foto_ktp',
                            'nama_file' => $model->foto_ktp
                        ]
                    ],
                ],
                'overwriteInitial' => true,
                'maxFileSize' => 2800
            ]
        ])
            ->label('Foto KTP')
        ?> </div>
</div>