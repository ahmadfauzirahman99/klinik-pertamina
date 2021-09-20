<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Barang;

/**
 * BarangSearch represents the model behind the search form of `app\models\Barang`.
 */
class BarangSearch extends Barang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'created_at', 'updated_at', 'deleted_at', 'riwayat', 'jenis', 'merk', 'nama_barang', 'keterangan', 'lokasi', 'gambar'], 'safe'],
            [['created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_kategori', 'id_satuan'], 'integer'],
            [['harga_terakhir', 'harga_tertinggi', 'harga_jual', 'stok'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Barang::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'id_kategori' => $this->id_kategori,
            'id_satuan' => $this->id_satuan,
            'harga_terakhir' => $this->harga_terakhir,
            'harga_tertinggi' => $this->harga_tertinggi,
            'harga_jual' => $this->harga_jual,
            'stok' => $this->stok,
        ]);

        $query->andFilterWhere(['like', 'id_barang', $this->id_barang])
            ->andFilterWhere(['like', 'riwayat', $this->riwayat])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'merk', $this->merk])
            ->andFilterWhere(['like', 'nama_barang', $this->nama_barang])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'gambar', $this->gambar]);

        return $dataProvider;
    }
}
