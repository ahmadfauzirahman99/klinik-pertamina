<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resep;

/**
 * ResepSearch represents the model behind the search form of `app\models\Resep`.
 */
class ResepSearch extends Resep
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_resep', 'created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_poli', 'is_retur', 'retur_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'riwayat', 'no_daftar', 'no_rm', 'id_dokter', 'tanggal', 'jam', 'tanggal_retur'], 'safe'],
            [['total_harga', 'diskon_persen', 'diskon_total', 'total_bayar'], 'number'],
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
        $query = Resep::find();

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
            'id_resep' => $this->id_resep,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'id_poli' => $this->id_poli,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'is_retur' => $this->is_retur,
            'tanggal_retur' => $this->tanggal_retur,
            'retur_by' => $this->retur_by,
            'total_harga' => $this->total_harga,
            'diskon_persen' => $this->diskon_persen,
            'diskon_total' => $this->diskon_total,
            'total_bayar' => $this->total_bayar,
        ]);

        $query->andFilterWhere(['like', 'riwayat', $this->riwayat])
            ->andFilterWhere(['like', 'no_daftar', $this->no_daftar])
            ->andFilterWhere(['like', 'no_rm', $this->no_rm])
            ->andFilterWhere(['like', 'id_dokter', $this->id_dokter]);

        return $dataProvider;
    }
}
