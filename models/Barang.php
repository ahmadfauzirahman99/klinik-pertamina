<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_barang".
 *
 * @property string $id_barang
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 * @property string|null $riwayat
 * @property string $jenis
 * @property int $id_kategori
 * @property int $id_satuan
 * @property string|null $merk
 * @property string $nama_barang
 * @property string|null $keterangan
 * @property string|null $lokasi
 * @property string|null $gambar
 * @property float $harga_terakhir
 * @property float $harga_tertinggi
 * @property float $harga_jual
 * @property float $stok
 */
class Barang extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id_barang', 'id_kategori', 'id_satuan', 'nama_barang', 'harga_terakhir', 'harga_tertinggi', 'harga_jual', 'stok'], 'required'],
            [[ 'id_satuan', 'nama_barang', 'harga_terakhir', 'harga_tertinggi', 'harga_jual', 'stok'], 'required'],
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_kategori', 'id_satuan'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['riwayat', 'jenis'], 'string'],
            [['harga_terakhir', 'harga_tertinggi', 'harga_jual', 'stok'], 'number'],
            [['id_barang', 'merk', 'lokasi'], 'string', 'max' => 100],
            [['nama_barang', 'gambar'], 'string', 'max' => 200],
            [['keterangan'], 'string', 'max' => 500],
            [['id_barang'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_barang' => 'Id Barang',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'is_deleted' => 'Is Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
            'riwayat' => 'Riwayat',
            'jenis' => 'Jenis',
            'id_kategori' => 'Id Kategori',
            'id_satuan' => 'Id Satuan',
            'merk' => 'Merk',
            'nama_barang' => 'Nama Barang',
            'keterangan' => 'Keterangan',
            'lokasi' => 'Lokasi',
            'gambar' => 'Gambar',
            'harga_terakhir' => 'Harga Terakhir',
            'harga_tertinggi' => 'Harga Tertinggi',
            'harga_jual' => 'Harga Jual',
            'stok' => 'Stok',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BarangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarangQuery(get_called_class());
    }

    public function setKodeBarang()
    {
        $last_id_barang = Self::find()->select('id_barang')->orderBy(['id_barang' => SORT_DESC])->one();
        $int_id_barang = intval(substr($last_id_barang->id_barang, 1));
        $this->id_barang = 'B' . sprintf('%04s', $int_id_barang + 1);
    }

    public function getSatuan()
    {
        return $this->hasOne(Satuan::className(), ['id_satuan' => 'id_satuan']);
    }
}
