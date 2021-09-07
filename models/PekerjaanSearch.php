<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pekerjaan;

/**
 * PekerjaanSearch represents the model behind the search form of `app\models\Pekerjaan`.
 */
class PekerjaanSearch extends Pekerjaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pekerjaan', 'aktif'], 'integer'],
            [['nama_pekerjaan'], 'safe'],
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
        $query = Pekerjaan::find()->orderBy('nama_pekerjaan ASC');

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
            'id_pekerjaan' => $this->id_pekerjaan,
            'aktif' => $this->aktif,
        ]);

        $query->andFilterWhere(['like', 'nama_pekerjaan', $this->nama_pekerjaan]);

        return $dataProvider;
    }
}
