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

    <?= $this->render('/layouts/kop-surat-pdf') ?>

    <br>
    <table class="w-100 tabel-default">
        <tbody>
            <tr>
                <td colspan="4" style="text-align: center; border-top: solid 1px black; border-top: unset !important; border-bottom: solid 1px black; font-weight: bold;">RINCIAN BIAYA</td>
            </tr>
            <tr>
                <td style="width: 25%;">No. RM</td>
                <td style="width: 25%;"><?= $pasien->no_rekam_medik ?></td>
                <td style="width: 25%;">No. Daftar</td>
                <td style="width: 25%;"><?= $pendaftaran->id_pendaftaran ?></td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td><?= $pasien->nama_lengkap ?></td>
                <td>Tgl. Daftar</td>
                <td><?= Yii::$app->formatter->asDate($resep->tanggal) ?></td>
            </tr>
            <tr>
                <td>Tgl. Lahir</td>
                <td><?= $pasien->tanggal_lahir ?></td>
                
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $pasien->alamat_lengkap ?></td>
                <td>Umur</td>
                <td><?= Helper::MenghitungUmur($pasien->tanggal_lahir) ?></td>
            </tr>
        </tbody>
    </table>
    <table class="w-100 tabel-default">
        <tbody>
            <tr>
                <td style="width: 25%; border-top: dashed 1px black;" colspan="2">Cara Bayar</td>
                <td style="width: 75%; border-top: dashed 1px black;"><?= $pendaftaran->caraBayar->nama ?></td>
            </tr>
            <tr>
                <td style="width: 5%; border-bottom: dashed 1px black;"></td>
                <td style="width: 20%; border-bottom: dashed 1px black;">No. Kartu</td>
                <td style="border-bottom: dashed 1px black;"><?= $pasien->no_kepesertaan ?></td>
            </tr>
        </tbody>
    </table>

    <table class="w-100 tabel-default">
        <tbody>
            <tr>
                <td style="width: 50%;"></td>
                <td class="text-right" style="width: 50%; font-weight: bold; font-size: 0.9rem;">Tgl. CETAK: <?= Yii::$app->formatter->asDate(date('Y-m-d H:i:s'), 'php:d-M-Y H:i:s') ?></td>
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

    <table class="tabel-rincian">
        <thead>
            <tr>
                <td colspan="2" style="border: unset !important; text-decoration: underline;">BIAYA OBAT Racikan</td>
            </tr>

            <tr>
                <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important; width: 5%;">#</td>
                <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Nama Racikan</td>
                <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important;">Racikan</td>
            </tr>
        </thead>
        <tbody>
            <?php if ((isset($racikan->racikan))) { ?>
                <?php foreach ($racikan->racikan as $keyRacikan => $valueRacikan) { ?>
                    <tr>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important; width: 5%;"><?= $keyRacikan + 1 ?></td>
                        <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important; width: 30%;"><?= $valueRacikan->keterangan ?></td>
                        <td class="teks-kecil bg-info text-white" style="border-top: unset !important; width: 65%;">
                            <table class="tabel-rincian">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $jumlahPerTotalRacikan = 0; ?>
                                    <?php foreach ($valueRacikan->racikanDetail as  $keyRacikanDetail => $valueRacikanDetail) { ?>
                                        <tr>
                                            <td class="teks-kecil text-center bg-info text-white" style="border-top: unset !important; width: 5%;"><?= $keyRacikanDetail + 1 ?></td>
                                            <td><?= $valueRacikanDetail->barang->nama_barang ?></td>
                                            <td class="teks-kecil text-right" style="width: 13%; border-bottom: dashed 1px black;"><?= Yii::$app->formatter->asDecimal($valueRacikanDetail->jumlah) ?></td>
                                            <td class="teks-kecil text-right" style="width: 13%; border-bottom: dashed 1px black;"><?= Yii::$app->formatter->asDecimal($valueRacikanDetail->harga_jual) ?></td>
                                            <td class="teks-kecil text-right" style="width: 13%; border-bottom: dashed 1px black;"><?= Yii::$app->formatter->asDecimal($valueRacikanDetail->subtotal) ?></td>

                                            <?= $jumlahPerTotalRacikan+=$valueRacikanDetail->subtotal ?>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td class="teks-kecil text-right" style="width: 13%; border-bottom: dashed 1px black;"><?= Yii::$app->formatter->asDecimal($jumlahPerTotalRacikan) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
            <?php } ?>
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
                    <td>BIAYA OBAT RACIKAN</td>
                    <td>Rp.</td>
                    <td class="text-right"><?= Yii::$app->formatter->asDecimal($racikan->total_biaya_racikan ?? 0) ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td class="text-bold">TOTAL BIAYA</td>
                    <td class="text-bold" style="border-top: solid 1px black;">Rp.</td>
                    <td class="text-bold text-right" style="border-top: solid 1px black;"><?= Yii::$app->formatter->asDecimal($model->sisa_pembayaran) ?></td>
                </tr>
            </tbody>
        </table>

        TERBILANG
        <div class="text-bold" style="text-transform: uppercase; border: solid 1px black; border-radius: 3px; padding: 5px;">
            <?= Helper::terbilang(round($model->sisa_pembayaran)) ?> RUPIAH
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

                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</div>