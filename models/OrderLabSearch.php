<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderLab;

/**
 * OrderLabSearch represents the model behind the search form about `app\models\OrderLab`.
 */
class OrderLabSearch extends OrderLab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lab', 'poli_id'], 'integer'],
            [['no_transaksi', 'diagnosa', 'kondisi_sampel', 'catatan', 'no_rekam_medik', 'no_daftar', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = OrderLab::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_lab' => $this->id_lab,
            'poli_id' => $this->poli_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_transaksi', $this->no_transaksi])
            ->andFilterWhere(['like', 'diagnosa', $this->diagnosa])
            ->andFilterWhere(['like', 'kondisi_sampel', $this->kondisi_sampel])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'no_rekam_medik', $this->no_rekam_medik])
            ->andFilterWhere(['like', 'no_daftar', $this->no_daftar])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
