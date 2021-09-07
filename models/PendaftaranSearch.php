<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pendaftaran;

/**
 * PendaftaranSearch represents the model behind the search form of `app\models\Pendaftaran`.
 */
class PendaftaranSearch extends Pendaftaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pendaftaran', 'kode_pasien', 'tgl_masuk', 'tgl_keluar', 'id_kiriman', 'id_cara_bayar', 'created_by', 'created_at', 'updated_by', 'updated_at', 'is_delete', 'type'], 'safe'],
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
        $query = Pendaftaran::find();

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
            'tgl_masuk' => $this->tgl_masuk,
            'tgl_keluar' => $this->tgl_keluar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'id_pendaftaran', $this->id_pendaftaran])
            ->andFilterWhere(['like', 'kode_pasien', $this->kode_pasien])
            ->andFilterWhere(['like', 'id_kiriman', $this->id_kiriman])
            ->andFilterWhere(['like', 'id_cara_bayar', $this->id_cara_bayar])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'is_delete', $this->is_delete])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
