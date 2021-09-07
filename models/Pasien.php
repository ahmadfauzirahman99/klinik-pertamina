<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id_patient
 * @property string $no_identitas
 * @property string|null $no_rekam_medik
 * @property string|null $no_kepesertaan
 * @property string $nama_lengkap
 * @property string $jenis_kelamin
 * @property string|null $alamat_lengkap
 * @property int|null $kel
 * @property int|null $kec
 * @property int|null $kab
 * @property string|null $no_tlp_pasien
 * @property string|null $agama
 * @property string|null $status_perkawinan
 * @property string|null $pendidikan_terakhir
 * @property string|null $pekerjaan_terakhir
 * @property string|null $profesi
 * @property string|null $kewenegaraan
 * @property int|null $cara_pembayaran
 * @property string|null $nama_penanggung_jawab
 * @property string|null $is_penanggung_jawab
 * @property string|null $hubungan_dengan_pasien
 * @property string|null $no_telp
 * @property string|null $rt
 * @property string|null $rw
 * @property int|null $crt_by
 * @property string|null $anak_keberapa
 * @property string|null $nama_ayah
 * @property string|null $nama_ibu
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $status_pasien
 * @property string|null $foto
 * @property string|null $foto_ktp
 * @property string|null $status_pekerjaan
 * @property string $crt
 * @property string $upd
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_identitas', 'nama_lengkap', 'jenis_kelamin'], 'required'],
            [['jenis_kelamin', 'alamat_lengkap', 'agama', 'status_perkawinan', 'kewenegaraan', 'foto', 'foto_ktp'], 'string'],
            [['kel', 'kec', 'kab', 'cara_pembayaran', 'crt_by'], 'integer'],
            [['tanggal_lahir', 'crt', 'upd'], 'safe'],
            [['no_identitas'], 'string', 'max' => 20],
            [['no_rekam_medik', 'no_kepesertaan', 'nama_lengkap', 'no_tlp_pasien', 'pendidikan_terakhir', 'pekerjaan_terakhir', 'profesi', 'is_penanggung_jawab', 'hubungan_dengan_pasien', 'no_telp', 'anak_keberapa', 'nama_ayah', 'nama_ibu', 'tempat_lahir', 'status_pasien', 'status_pekerjaan'], 'string', 'max' => 100],
            [['nama_penanggung_jawab'], 'string', 'max' => 200],
            [['rt', 'rw'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_patient' => 'Id Patient',
            'no_identitas' => 'No Identitas',
            'no_rekam_medik' => 'No RM',
            'no_kepesertaan' => 'No Anggota',
            'nama_lengkap' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat_lengkap' => 'Alamat Lengkap',
            'kel' => 'Kel',
            'kec' => 'Kec',
            'kab' => 'Kab',
            'no_tlp_pasien' => 'No Telepon Pasien',
            'agama' => 'Agama',
            'status_perkawinan' => 'Status Perkawinan',
            'pendidikan_terakhir' => 'Pendidikan',
            'pekerjaan_terakhir' => 'Pekerjaan',
            'profesi' => 'Profesi',
            'kewenegaraan' => 'Kewenegaraan',
            'cara_pembayaran' => 'Cara Pembayaran',
            'nama_penanggung_jawab' => 'Nama ',
            'is_penanggung_jawab' => 'Is Penanggung Jawab',
            'hubungan_dengan_pasien' => 'Hubungan',
            'no_telp' => 'No Telepon',
            'rt' => 'RT',
            'rw' => 'RW',
            'crt_by' => 'Crt By',
            'anak_keberapa' => 'Anak Keberapa',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'status_pasien' => 'Status Pasien',
            'foto' => 'Foto',
            'foto_ktp' => 'Foto KTP',
            'status_pekerjaan' => 'Status Pekerjaan',
            'crt' => 'Crt',
            'upd' => 'Upd',
        ];
    }

    public function getPekerjaan()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'pekerjaan_terakhir']);
    }
}
