<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2020-11-29 23:02:06 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-01-10 22:04:50
 */

use yii\helpers\Url;

$logo = Url::to('@web/img/pertamina-square.png');
$logo2 = Url::to('@web/img/akreditasi.jpg');
$logo3 = Url::to('@web/img/klinik.png');

?>

<table width="100%" cellpadding="1" cellspacing="0">
    <tr>
        <td style=" text-align: right;">
            <img src="<?= $logo3 ?>" alt="logo" style="height: 70px; width: auto;">
            <br>
        </td>
        <td><br></td>
        <!-- <td style="font-size:15px;text-align:center">
            <span style="font-weight: bold; line-height: 0 !important;">
                <span style="font-size: 16px; line-height: 0 !important;">
                    PEMERINTAH PROVINSI RIAU
                </span>
                <br>
                <span style="font-size: 22px; line-height: 0.8 !important;">
                    <?php //Yii::$app->params['nama-rs'] ?>
                </span>
            </span>
            <br>
            <div style="line-height: 1 !important; margin-top: 10px;">
                <span style="font-size: small; line-height: 0 !important;">
                    <?php //Yii::$app->params['alamat-rs'] ?>
                </span>
                <br>
                <span style="font-size: small; line-height: 0.8 !important;">
                    <?php //Yii::$app->params['kota-rs'] ?>
                </span>
            </div>
        </td> -->
        
    </tr>
    <tr>
        <td colspan="4">
            <table width="100%">
                <tr>
                    <td style="background-color:black"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>