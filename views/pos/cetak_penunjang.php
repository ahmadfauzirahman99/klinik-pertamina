<?php

use app\components\HelperPegawai;
use yii\helpers\Inflector;
use yii\helpers\Url;


?>
<style>

.tabelobat {
	border-collapse: collapse;
}
.tabelobat tr th {
  border: 1px solid black;	
}
.tabelobat tr td {
  border: 1px solid black;	
}
</style>
<div class="col-md-12" style="padding:2%;">
	<!-- kop surat -->
	<?= $this->render('/layouts/kop-surat-pdf') ?>

	<br>
	<table style="text-align:center; font-size: 0.9em;" border="0" width="100%">
		<tr>
			<td colspan="2" align="center" height="">
				<h4>INVOICE BIAYA PERAWATAN</h4>
			</td>
		</tr>
        <hr>
		<tr><td></td></tr>
		<tr>
			<td width="20%" align="left">Nomor Transaksi </td>
			<td width="80%" align="left">:&nbsp;<?php echo $model['no_transaksi']; ?></td>
		</tr>
		<!-- <tr>
			<td width="20%" align="left">Unit yang meminta</td>
			<td width="80%" align="left">:&nbsp;<?php //echo strtoupper($model->unit->nama); ?></td>
		</tr> -->
		<tr>
			<td width="20%" align="left">No Rekam Medik</td>
			<td width="80%" align="left">:&nbsp;<?php echo strtoupper($model['no_rekam_medik']); ?></td>
		</tr>
        <tr>
			<td width="20%" align="left">No Registrasi</td>
			<td width="80%" align="left">:&nbsp;<?php echo strtoupper($model['no_daftar']); ?></td>
		</tr>
        <tr>
			<td width="20%" align="left">Nama Pasien</td>
			<td width="80%" align="left">:&nbsp;<?php echo strtoupper($model['nama_pasien']); ?></td>
		</tr>
        <tr>
			<td width="20%" align="left">Alamat Pasien</td>
			<td width="80%" align="left">:&nbsp;<?php echo strtoupper($model['alamat_lengkap']); ?></td>
		</tr>
	</table>
    
	<br>
	<table class="tabelobat" width="100%" border="1" cellpadding="2" cellspacing="0" style="text-align:center; font-size: 0.9em;">
		<tr class="headtable">
			<th width="5%">No</th>
			<th width="44%">Nama Tindakan</th>
			<th width="10%">Jml. Tindakan </th>
			<th width="10%">Harga. Tindakan </th>
			<th width="13%">Sub Total</th>
			<th width="15%">Keterangan</th>
		</tr>
		<?php
		$no = 1;
		$temp = '';
        $total = 0;
		// $menerimaPermintaan = '';
		foreach ($modelDetail as $data) :
            $total += $data['subtotal'];
            
            // var_dump($modelDetail);
            // die();
			// if ($temp != $data['nama_jenis']) {
		?>
				<!-- <tr>
					<td colspan="6" style="text-align: left; font-weight: bold;">&nbsp;<?php //echo $data['nama_jenis'] ?></td>
				</tr> -->
			<?php
			// 	$temp = $data['nama_jenis'];
			// }
			?>
			<tr>
				<td style="text-align:center"><?php echo $no; ?></td>
				<td style="text-align:left">&nbsp;<?php echo $data['nama_item']; ?></td>
				<td style="text-align:center"><?php echo $data['jumlah']; ?></td>
				<td style="text-align:center"><?php echo Yii::$app->formatter->asDecimal($data['harga_tindakan']); ?></td>
				<td style="text-align:center"><?php echo Yii::$app->formatter->asDecimal($data['subtotal']); ?></td>
				<td style="text-align:center"><?php echo $data['catatan']; ?>&nbsp;</td>
				
			</tr>
		<?php
			$no++;
		endforeach;
		?>
        <tr>
            <td tyle="text-align:center" colspan ="4"> Total</td>
            <td><?php echo Yii::$app->formatter->asDecimal($total); ?></td>
            <td></td>
        </tr>
	</table>
	<br>
	<table border="0" width="100%" style="font-size: 0.9em;">
		<tr>
			<td style="text-align:right;margin-bottom:20px" colspan="4">
				Pekanbaru, <?php echo date("d-m-Y"); ?>
			</td>
		</tr>
		<tr>
			<td style="width: 25%; text-align: center; vertical-align: text-top;">
				Mengetahui<br>Pj. <?php //Inflector::camel2words($model->unitTujuan->nama) ?>
			</td>
			<td style="width: 25%; text-align: center; vertical-align: text-top;">
				Yang Meminta
			</td>
			<td style="width: 25%; text-align: center; vertical-align: text-top;">
				Yang menerima Permintaan
			</td>
			<td style="width: 25%; text-align: center; vertical-align: text-top;">
				Mengetahui<br>Ka. <?php //Inflector::camel2words($model->unitAsal->nama) ?>
			</td>
		</tr>
		<tr>
			<td style="font-size: 0.8rem; width: 25%; text-align: center; vertical-align: text-bottom;">
			<br>
			<br>
			<br>
			<br>

				<span style="text-decoration: underline;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span>
			</td>
			<td style="font-size: 0.8rem; width: 25%; text-align: center; vertical-align: text-bottom;">
			<br>
			<br>
			<br>
			<br>

				<span style="text-decoration: underline;"><?php //$model->permintaan->createdByTeks->nama ?? null ?></span>
			</td>
			<td style="font-size: 0.8rem; width: 25%; text-align: center; vertical-align: text-bottom;">
			<br>
			<br>
			<br>
			<br>

				<span style="text-decoration: underline;"><?php //$model->updatedByTeks->nama ?></span>
			</td>
			<td style="font-size: 0.8rem; width: 25%; text-align: center; vertical-align: text-bottom;">
			<br>
			<br>
			<br>
			<br>

				<span style="text-decoration: underline;"><?php //HelperPegawai::jabatan('PENANGGUNG JAWAB GUDANG PERBEKALAN FARMASI')->nama ?></span>
			</td>
		</tr>
	</table>

</div>