<?php



namespace app\components;

use app\models\Pasien;
use app\models\Pendaftaran;
use DateTime;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Helper
{
    static function createNomorRekamMedik()
    {
        $query =  Pasien::find()
            ->select(['id_patient'])
            ->orderBy('id_patient DESC')
            ->limit(1)
            ->asArray()
            ->one();

        return !empty($query) ? $query['id_patient'] : false;
    }

    public static function GenerateId()
    {
        $kode = date('ymdHis');

        // $cek = Pendaftaran::find()
        //     ->select(['coalesce(Max(substring(id_pendaftaran,13,4)), Cast(0 as Varchar(1))) as id'])
        //     ->andWhere(['coalesce(substring(id_pendaftaran,1,12), Cast(1 as Varchar(1)))' => $kode])
        //     ->asArray()
        //     ->one();
        $cek = Pendaftaran::find()
            ->select(['id_pendaftaran as id'])
            ->orderBy([
                'id_pendaftaran' => SORT_DESC,
            ])
            ->asArray()
            ->one();
        // var_dump($cek);
        // exit;

        // if ($cek != Null) {
        //     if (count($cek) > 0) {
        //         $id = $kode . sprintf("%'.04d", ($cek['id'] + 1));
        //     } else {
        //         $id = $kode . '0001';
        //     }
        // }
        if (!is_null($cek)) {
            $cek['id'] = substr($cek['id'], -4);

            $id = $kode . sprintf("%'.04d", ((int) $cek['id'] + 1));
        } else {
            $id = $kode . '0001';
        }
        return $id;
    }

    public static function MenghitungUmur($tanggal_lahir)
    {
        // tanggal lahir
        $tanggal = new DateTime($tanggal_lahir);

        // tanggal hari ini
        $today = new DateTime('today');

        // tahun
        $y = $today->diff($tanggal)->y;

        // bulan
        $m = $today->diff($tanggal)->m;

        // hari
        $d = $today->diff($tanggal)->d;
        return  $y . " tahun " . $m . " bulan " . $d . " hari";
    }

    public static function getQrCode($string)
    {
        $barcode = new \Com\Tecnick\Barcode\Barcode();
        // generate a barcode
        $bobj = $barcode->getBarcodeObj(
            'QRCODE,H',                     // barcode type and additional comma-separated parameters
            $string,        // data string to encode
            -3,                             // bar width (use absolute or negative value as multiplication factor)
            -3,                             // bar height (use absolute or negative value as multiplication factor)
            'black',                        // foreground color
            array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
        )->setBackgroundColor('white'); // background color

        return $bobj->getPngData();
    }


    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = self::penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = self::penyebut($nilai / 10) . " puluh" . self::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . self::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::penyebut($nilai / 100) . " ratus" . self::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . self::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::penyebut($nilai / 1000) . " ribu" . self::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::penyebut($nilai / 1000000) . " juta" . self::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::penyebut($nilai / 1000000000) . " milyar" . self::penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::penyebut($nilai / 1000000000000) . " trilyun" . self::penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    static function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }
        return $hasil;
    }

    public static function batchInsert($tableName, $columnNameArray, $bulkInsertArray)
    {
        // \Yii::$app->db->createCommand()->truncateTable($tableName)->execute();
        $insertCount = Yii::$app->db->createCommand()
            ->batchInsert($tableName, $columnNameArray, $bulkInsertArray)
            ->execute();
        return $insertCount;
    }

    public static function jsonPretty($json)
    {
        $json = json_decode($json, 1);
        $json_pretty = json_encode($json, JSON_PRETTY_PRINT);
        return $json_pretty;
    }

    public static function sendTrackTelegram($text_nya)
    {
        // self::sendTrackTelegramSend($text_nya);

        // $desired_width = 4000;
        $desired_width = 3000;
        $str = wordwrap($text_nya, $desired_width, "________");
        $arr = explode("________", $str);
        // echo "<pre>";
        // print_r($arr);
        // exit;
        foreach ($arr as $key => $a) {
            $texz = $a;
            if ($key > 0) {
                sleep(2);
                $texz = "..." . $a;
            }
            self::sendTrackTelegramSend($texz);
            if ($key > 3) {
                break;
            }
        }
        // die;
    }

    public static function sendTrackTelegramSend($text_nya)
    {
        // $text_nya = "<code>" . $text_nya . "</code>";
        if (YII_ENV_DEV) {
            $text_nya = "[DEV] \n" . $text_nya;
        }
        // senDebugExternelTelegram
        //
        //TELEGRAM

        $tokenapi = "bot5303733689:AAFUaiy_iN9HiBTfXh-6ueqc2GP6-tthxzw";
        $chatidapi = "-1001662592936";
        $urlnya = "https://api.telegram.org/$tokenapi/sendMessage?&parse_mode=HTML&chat_id=$chatidapi";
        // $send = str_replace('<br>', PHP_EOL, $hasil);
        $send = ("");
        // @file_get_contents('https://api.telegram.org/'.$tokenapi.'/sendMessage?chat_id='.$chatidapi.'&text='.$send."&parse_mode=HTML");
        // exit;

        // set post fields
        $post = [
            'text' => $text_nya
            // 'text' => json_encode($hasil)
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlnya);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000); //async tanpa nunggu hasil
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        //

    }

    public static function sendFileTelegram($filenya)
    {
        // $url_blob = '/path/to/new/file_name';
        $rand = rand();
        $url_blob = "temp/temp-$rand-yea.txt";
        $url_blob_web = Url::to("@web/" . $url_blob);
        file_put_contents($url_blob, $filenya);
        //TELEGRAM

        $tokenapi = "bot5303733689:AAFUaiy_iN9HiBTfXh-6ueqc2GP6-tthxzw";
        $chatidapi = "-1001662592936";
        // $urlnya = "https://api.telegram.org/$tokenapi/sendDocument?document=$url_blob_web&chat_id=$chatidapi";
        $urlnya = "https://api.telegram.org/$tokenapi/sendMessage?document=$url_blob_web&chat_id=$chatidapi";
        // $send = str_replace('<br>', PHP_EOL, $hasil);
        $send = ("");
        // @file_get_contents('https://api.telegram.org/'.$tokenapi.'/sendMessage?chat_id='.$chatidapi.'&text='.$send."&parse_mode=HTML");
        // exit;

        // set post fields
        $post = [
            'text' => $url_blob_web
            // 'text' => json_encode($hasil)
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlnya);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000); //async tanpa nunggu hasil
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        curl_close($ch);
        //
    }

    static function Intial($nama)
    {
        $arr = explode(' ', $nama);
        $singkatan = '';

        foreach ($arr as $kata) {
            $singkatan .= substr($kata, 0, 1);
        }

        return $singkatan;
    }
}
