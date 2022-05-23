<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-05-30 21:47:13 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-05-31 00:48:40
 */

use yii\widgets\Pjax;

?>

<div class="">
    <?php Pjax::begin([
        'id' => 'timeline-kunjungan',
        'timeout' => false,
    ]); ?>
    <!-- The timeline -->
    <div class="timeline timeline-inverse">
        <?php
        $warnaBg = [
            'custom',
            // 'secondary',
            'info',
            'success',
            'warning',
            'danger',
            'pink',
            'gray',
            'inverse'
        
        ];

        foreach ($model_timeline_kunjungan as $key => $value) {
            echo '
                <div class="time-label">
                    <span class="bg-orange">
                        ' . Yii::$app->formatter->asDate($key, 'php:d F Y') . '
                    </span>
                </div>
            ';
            foreach ($value as $keyItem => $valueItem) {
                if ($valueItem['status_layanan'] == 'DAFTAR')
                    $warnaItem = 'pink';
                if ($valueItem['status_layanan'] == 'DILAYANI')
                    $warnaItem = 'info';
                if ($valueItem['status_layanan'] == 'SELESAI')
                    $warnaItem = 'teal';
                if ($valueItem['status_layanan'] == 'BATAL')
                    $warnaItem = 'orange';

                // $warnaItem = '';

                //<!-- timeline item -->
                echo '
                <div class="timeline">
                        <article class="timeline-item alt">
                            <div class="text-right">
                            <div class="time-show first">
                                <a href="#" class="btn btn-'.$warnaBg[rand(0, 7)].' w-lg">'.$valueItem['nama_poli'].'</a>
                            </div>
                            </div>
                        </article>
                        <article class="timeline-item alt">
                            <div class="timeline-desk">
                                <div class="panel">
                                    <div class="panel-body">
                                        <span class="arrow-alt"></span>
                                        <span class="timeline-icon bg-'.$warnaBg[rand(0, 7)].'"><i class="mdi mdi-circle"></i></span>
                                        <h4 class="text-danger">No. Registrasi:</span>  ' . $valueItem['id_pendaftaran'] . '</h4>
                                        <p class="timeline-date text-muted"><small>'.Yii::$app->formatter->asDatetime($valueItem['tgl_masuk']).'</small></p>
                                        <p>Status Layanan - ' .$valueItem['status_layanan'].' </p>
                                        <p><button class="btn btn-primary">Detail</button></p>
                                    </div>
                                </div>
                            </div>
                        </article>
                </div>
                   
                ';
            }
        }

        ?>
        <div>
            <i class="far fa-clock bg-gray"></i>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>