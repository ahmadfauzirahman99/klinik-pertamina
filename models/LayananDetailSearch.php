<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LayananDetail;

/**
 * LayananDetailSearch represents the model behind the search form of `app\models\LayananDetail`.
 */
class LayananDetailSearch extends LayananDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_layanan_detail', 'created_by', 'updated_by', 'is_deleted', 'deleted_by', 'id_layanan', 'id_tindakan'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'riwayat', 'keterangan', 'status'], 'safe'],
            [['harga_jual', 'jumlah', 'subtotal'], 'number'],
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
        $query = LayananDetail::find();

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
            'id_layanan_detail' => $this->id_layanan_detail,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'is_deleted' => $this->is_deleted,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'id_layanan' => $this->id_layanan,
            'id_tindakan' => $this->id_tindakan,
            'harga_jual' => $this->harga_jual,
            'jumlah' => $this->jumlah,
            'subtotal' => $this->subtotal,
        ]);

        $query->andFilterWhere(['like', 'riwayat', $this->riwayat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
