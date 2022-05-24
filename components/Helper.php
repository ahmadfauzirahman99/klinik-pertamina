<?php



namespace app\components;

use app\models\Pasien;
use app\models\Pendaftaran;
use DateTime;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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


    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = self::penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = self::penyebut($nilai/10)." puluh". self::penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . self::penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = self::penyebut($nilai/100) . " ratus" . self::penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . self::penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = self::penyebut($nilai/1000) . " ribu" . self::penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = self::penyebut($nilai/1000000) . " juta" . self::penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = self::penyebut($nilai/1000000000) . " milyar" . self::penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = self::penyebut($nilai/1000000000000) . " trilyun" . self::penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	static function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(self::penyebut($nilai));
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
}
