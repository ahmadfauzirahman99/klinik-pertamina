<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResumeRawatJalan;

/**
 * ResumeRawatJalanSearch represents the model behind the search form of `app\models\ResumeRawatJalan`.
 */
class ResumeRawatJalanSearch extends ResumeRawatJalan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_resume_rawat_jalan', 'no_rekam_medik', 'no_daftar'], 'integer'],
            [['anamnesa', 'hasil_penunjang', 'diaganosa', 'therapy', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = ResumeRawatJalan::find();

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
            'id_resume_rawat_jalan' => $this->id_resume_rawat_jalan,
            'no_rekam_medik' => $this->no_rekam_medik,
            'no_daftar' => $this->no_daftar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'anamnesa', $this->anamnesa])
            ->andFilterWhere(['like', 'hasil_penunjang', $this->hasil_penunjang])
            ->andFilterWhere(['like', 'diaganosa', $this->diaganosa])
            ->andFilterWhere(['like', 'therapy', $this->therapy])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
