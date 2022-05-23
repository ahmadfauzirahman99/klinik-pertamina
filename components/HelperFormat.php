<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Web: dickyermawan.github.io 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2021-02-18 13:24:56 
 * @Last Modified by: Dicky Ermawan S., S.T., MTA
 * @Last Modified time: 2021-02-19 11:33:51
 */


namespace app\components;

use NumberFormatter;
use Yii;

class HelperFormat
{
    public static function rupiah($angka)
    {
        return str_replace(',', '.', str_replace('.', '', Yii::$app->formatter->asCurrency($angka)));
    }

    public static function terbilang($angka)
    {
        $f = new NumberFormatter('id-ID', NumberFormatter::SPELLOUT);
        return $f->format($angka);
    }
}
