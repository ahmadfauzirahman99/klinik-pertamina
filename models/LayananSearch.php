<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Layanan;

/**
 * LayananSearch represents the model behind the search form of `app\models\Layanan`.
 */
class LayananSearch extends Layanan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_layanan', 'jenis_layanan', 'unit_tujuan_kode', 'created_by', 'created_at', 'updated_by', 'deleted_by'], 'integer'],
            [['registrasi_kode', 'tgl_masuk', 'tgl_keluar', 'unit_kode', 'unit_asal_kode', 'keterangan', 'updated_at', 'deleted_at', 'status_layanan'], 'safe'],
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
        $query = Layanan::find();

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
            'id_layanan' => $this->id_layanan,
            'jenis_layanan' => $this->jenis_layanan,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'unit_tujuan_kode' => $this->unit_tujuan_kode,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'registrasi_kode', $this->registrasi_kode])
            ->andFilterWhere(['like', 'unit_kode', $this->unit_kode])
            ->andFilterWhere(['like', 'unit_asal_kode', $this->unit_asal_kode])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status_layanan', $this->status_layanan]);

        return $dataProvider;
    }

    public function searchPasien($params, $id = null)
    {
        $query = Layanan::find()
            ->joinWith(['pendaftaran p'])
            ->joinWith(['unit'])
            ->where([
                'p.kode_pasien' => $id
            ])
            ->orderBy('id_layanan DESC');

            // var_dump($query->all());
            // exit;

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
            'id_layanan' => $this->id_layanan,
            'jenis_layanan' => $this->jenis_layanan,
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'unit_asal_kode' => $this->unit_asal_kode,
            'unit_tujuan_kode' => $this->unit_tujuan_kode,
            'keterangan' => $this->keterangan,
            'status_layanan' => $this->status_layanan,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'registrasi_kode', $this->registrasi_kode])
            ->andFilterWhere(['like', 'unit_kode', $this->unit_kode]);

        return $dataProvider;
    }
}
