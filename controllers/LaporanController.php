<?php

namespace app\controllers;

use app\models\Resep;
use app\models\Pendaftaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\helpers\ArrayHelper;
use Exception;

set_time_limit(0);
ini_set("pcre.backtrack_limit", "5000000");
class LaporanController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $hari_ini = "2021-01-01";
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));


        $model = Resep::find()->where(['>=', 'tanggal', $tgl_pertama])
            ->andWhere(['<=', 'tanggal', $tgl_terakhir])->all();
        return $this->render('index', ['model' => $model]);
    }

    public function actionCetakResepSemua($bulan)
    {
        // var_dump($bulan);
        // exit;
        ini_set("memory_limit", "8056M");
        ini_set('max_execution_time', 0);
        $hari_ini = "2022-{$bulan}-01";
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));


        $model = Resep::find()

            ->where(['>=', 'tanggal', $tgl_pertama])

            ->andWhere(['<=', 'tanggal', $tgl_terakhir])->all();

        // print_r($model->pasien);
        // exit;
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'legal',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 5,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        // $mpdf->SetWatermarkImage(Url::to('@web/img/syafira.png'), -1, [170, 100]);
        $mpdf->showWatermarkImage = true;

        $mpdf->SetTitle('Invoice Pertamina RUU II PAKNING');
        $mpdf->WriteHTML($this->renderPartial('cetak-resep-semua', [
            'model' => $model,

        ]));
        $mpdf->Output('Invoice RU II PAKNING' . '.pdf', 'I');
        exit;
    }
    public function actionKlinikRaw($view = null,$id=null)
    {
        $filename = 'excel_template/' . 'klinik_raw_data_template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
        // $worksheet[$nama_bulan] = $spreadsheet->getActiveSheet();


        $list_nama_bulan = [];
        $list_bulan = [1,2,3,4,5,6,7,8,9,10,11,12];
        foreach($list_bulan as $bulan){
            // $monthNum = 8;
            $nama_bulan = date("F", strtotime('00-'.$bulan.'-01')); // Output: Octobe
            $list_nama_bulan[$bulan]=$nama_bulan;
        
            // ---------------mulai
            
            $worksheet[$nama_bulan] = $spreadsheet->getSheetByName($nama_bulan);
            $rowRumus = "5"; 
            $columnCount = $worksheet[$nama_bulan]->getHighestColumn();
            $kolom =  \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($columnCount);
            

            $array_rumus = [];
            $array_isrumus = [];

            // dari baris ke 4
            for ($i = 1; $i <= $kolom; $i++) {
                $abc = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
                $list_kolom[] = $abc; 
                $list_kolom_and_row[] = $abc . $rowRumus;
                $list_kolom_and_row_replace[$abc . $rowRumus] = $abc . "__ROW__"; 
            }

            foreach ( $list_kolom as $abc) {
                $isi_cell = $worksheet[$nama_bulan]->getCell($abc . $rowRumus)->getValue();
                $isi_cell = (string)$isi_cell;
                $array_rumus[$abc] = ($isi_cell);
                $array_isrumus[$abc] = 0;

            }
            $bulanangka= sprintf('%02d', $bulan);
            $tahun= $id;
            $tglmulai = "$tahun-$bulanangka-01 00:00:00";
            $tglselesai = "$tahun-$bulanangka-31 23:59:59";

            $isian_ = Pendaftaran::find()
            ->joinWith('pasien')->joinWith('resep')
            ->andFilterWhere(['between', 'resep.tanggal', $tglmulai, $tglselesai])
            ->asArray()
            ->all();

            // baris ---------------------
            $columnCount_no_space = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($kolom-1);

            $baseRowTable = $rowRumus;
            $baseRow = count($isian_) + $rowRumus - 1;
            // $spreadsheet->getActiveSheet()
            $spreadsheet->getSheetByName($nama_bulan)
                ->getStyle("A{$baseRowTable}:$columnCount_no_space{$baseRow}")
                ->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            $isian = [];
            $number = 1;
            foreach($isian_ as $key_isi =>$val_isian){
                $isian[$key_isi][0] = $number; 
                $isian[$key_isi][1] = $val_isian['pasien']['nama_lengkap']??'-'; 
                $isian[$key_isi][2] = $val_isian['resep']['tanggal']??''; 
                $isian[$key_isi][3] = $val_isian['resep']['total_bayar']??'0'; 
            $number++;
            }
            foreach ($isian as $key_row=>$rowisi){
                foreach($rowisi as $key_kolom => $isi){
                    $key_kolom_abc = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($key_kolom+1);
                    $worksheet[$nama_bulan]->getCell($key_kolom_abc. ($key_row + $rowRumus))->setValue($isi);
                }
            }

            // -----------------
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        $hasilnya = $writer->save('excel_template/' . 'klinik_raw_hasil.xlsx');


        ob_clean();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=klink_raw_hasil.xlsx");
        header("Content-Transfer-Encoding: binary");
        header("Content-Description: File Transfer");
        readfile('excel_template/' . 'klinik_raw_hasil.xlsx');
        exit;
    }

}
