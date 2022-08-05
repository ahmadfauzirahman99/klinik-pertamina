<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\helpers\ArrayHelper;
use app\models\Pendaftaran;


class LaporanController extends Controller
{
    public function actionResume()
    {
        // return $this->render()
    }

    public function actionKlinikRaw($view = null)
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
            $tglmulai = "2022-$bulanangka-01 00:00:00";
            $tglselesai = "2022-$bulanangka-31 23:59:59";

            $isian_ = Pendaftaran::find()
            ->joinWith('pasien')->joinWith('resep')
            ->andFilterWhere(['between', 'tgl_masuk', $tglmulai, $tglselesai])
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
                $isian[$key_isi][2] = $val_isian['tgl_masuk']??''; 
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
