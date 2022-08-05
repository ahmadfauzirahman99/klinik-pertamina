<?php

use app\components\Helper;
use app\components\HelperFormat;

?>


<style>
    .teks-kecil {
        font-size: 0.9rem;
    }

    .text-center {
        text-align: center;
    }

    .text-bold {
        font-weight: bold;
    }

    .text-right {
        text-align: right;
    }

    .text-italic {
        font-style: italic;
    }

    .w-100 {
        width: 100%;
    }

    .tabel-default {
        border-collapse: collapse;
    }

    .tabel-default td {
        vertical-align: top;
    }

    .tabel-rincian {
        margin-top: 15px;
        width: 100%;
        border-collapse: collapse;
    }

    .tabel-rincian thead td.text-center {
        font-style: italic;
    }

    .tabel-rincian th,
    .tabel-rincian td {
        border-top: solid 0.1px #7a7b7d;
        border-bottom: solid 0.1px #7a7b7d;
        /* font-family: 'helvetica', sans-serif; */
    }
</style>
<div class="invoice">

    <?php foreach ($model as $resep) { ?>



        <?= $this->render('/layouts/kop-surat-pdf') ?>
        <br>
        <?php if ($resep->patient) { ?>
            <table class="w-100 tabel-default">
                <tbody>
                    <tr>
                        <td colspan="4" style="text-align: center; border-top: solid 1px black; border-top: unset !important; border-bottom: solid 1px black; font-weight: bold;">RINCIAN BIAYA</td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">No. RM</td>
                        <td style="width: 25%;"><?= $resep->patient->no_rekam_medik ?? null ?></td>
                        <td style="width: 25%;">No. Daftar</td>
                        <td style="width: 25%;"><?= $resep->pendaftaran->id_pendaftaran ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td><?= $resep->patient->nama_lengkap ?? null ?></td>
                        <td>Tgl. Daftar</td>
                        <td><?= Yii::$app->formatter->asDate($resep->tanggal) ?></td>
                    </tr>
                    <tr>
                        <td>Tgl. Lahir</td>
                        <td><?= $resep->patient->tanggal_lahir ?? null ?></td>

                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><?= $resep->patient->alamat_lengkap ?? null ?></td>
                        <td>Umur</td>
                        <td><?= Helper::MenghitungUmur($resep->patient->tanggal_lahir ?? null) ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="w-100 tabel-default">
                <tbody>
                    <tr>
                        <td style="width: 25%; border-top: dashed 1px black;" colspan="2">Cara Bayar</td>
                        <td style="width: 75%; border-top: dashed 1px black;"><?= $resep->pendaftaran->caraBayar->nama ?></td>
                    </tr>
                    <tr>
                        <td style="width: 5%; border-bottom: dashed 1px black;"></td>
                        <td style="width: 20%; border-bottom: dashed 1px black;">No. Kartu</td>
                        <td style="border-bottom: dashed 1px black;"><?= $resep->pasien->no_kepesertaan ?? null ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="w-100 tabel-default">
                <tbody>
                    <tr>
                        <td style="width: 50%;"></td>
                        <td class="text-right" style="width: 50%; font-weight: bold; font-size: 0.9rem;">Tgl. CETAK: <?= Yii::$app->formatter->asDate($resep->tanggal, 'php:d-M-Y H:i:s') ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="tabel-rincian">
                <thead>
                    <tr>
                        <td colspan="7" style="border: unset !important; text-decoration: underline;">BIAYA OBAT</td>
                    </tr>

                    <tr>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important; width: 5%;">#</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Barang</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Keterangan</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Dosis</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Jumlah</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Harga</td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ((isset($resep->resepDetail))) {
                        foreach ($resep->resepDetail as $key => $value) {
                            echo '
                        <tr>
                            <td class="teks-kecil text-center">' . ($key + 1) . '</td>
                            <td class="teks-kecil">' . $value->barang->nama_barang . '</td>
                            <td class="teks-kecil">' . $value->keterangan . '</td>
                            <td class="teks-kecil">' . $value->dosis . '</td>
                            <td class="teks-kecil text-center" style="width: 13%;">' . Yii::$app->formatter->asDecimal($value->jumlah) . '</td>
                            <td class="teks-kecil text-right" style="width: 13%;">' . Yii::$app->formatter->asDecimal($value->harga_jual) . '</td>
                            <td class="teks-kecil text-right" style="width: 13%;">' . Yii::$app->formatter->asDecimal($value->subtotal) . '</td>
                        </tr>
                    ';
                        }
                        echo ' 
                    <tr>
                        <td colspan="6" class="text-italic text-center" style="border-bottom: dashed 1px black;">Total</td>
                        <td class="teks-kecil text-right" style="width: 13%; border-bottom: dashed 1px black;">' . Yii::$app->formatter->asDecimal($resep->total_bayar) . '</td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>

            <div class="div-rekap" style="margin-top: 25px;">
                TOTAL / REKAPITULASI
                <table class="w-100 tabel-default">
                    <tbody>

                        <tr>
                            <td></td>
                            <td>BIAYA OBAT</td>
                            <td>Rp.</td>
                            <td class="text-right"><?= Yii::$app->formatter->asDecimal($resep->total_bayar ?? 0) ?></td>
                        </tr>


                        <tr>
                            <td></td>
                            <td class="text-bold">TOTAL BIAYA</td>
                            <td class="text-bold" style="border-top: solid 1px black;">Rp.</td>
                            <td class="text-bold text-right" style="border-top: solid 1px black;"><?= Yii::$app->formatter->asDecimal($resep->total_bayar ?? 0) ?></td>
                        </tr>
                    </tbody>
                </table>

                TERBILANG
                <div class="text-bold" style="text-transform: uppercase; border: solid 1px black; border-radius: 3px; padding: 5px;">
                    <?= Helper::terbilang(round($resep->total_bayar)) ?> RUPIAH
                </div>
            </div>

            <div class="div-petugas" style="margin-top: 25px;">
                <table class="w-100 tabel-default">
                    <tbody>
                        <tr>
                            <td style="width: 70%;"></td>
                            <td class="text-center" style="width: 30%; padding-left: 5%; padding-right: 5%;">
                                Petugas/Kasir
                                <br>
                                <img alt="DickMen" src="data:image/png;base64,'.<?= base64_encode(Helper::getQrCode('Pertamina RU II Pakning')) ?>.'" />
                                <br>
                                Diana Idrifa
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <?php } ?>

        <pagebreak></pagebreak>
    <?php }  ?>
</div>