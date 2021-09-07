<?php



namespace app\components;

use app\models\Pasien;
use app\models\Pendaftaran;
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

}
