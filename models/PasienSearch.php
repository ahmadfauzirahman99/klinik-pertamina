<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pasien;

/**
 * PasienSearch represents the model behind the search form of `app\models\Pasien`.
 */
class PasienSearch extends Pasien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_patient', 'kel', 'kec', 'kab', 'cara_pembayaran', 'crt_by'], 'integer'],
            [['no_identitas', 'no_rekam_medik', 'no_kepesertaan', 'nama_lengkap', 'jenis_kelamin', 'alamat_lengkap', 'no_tlp_pasien', 'agama', 'status_perkawinan', 'pendidikan_terakhir', 'pekerjaan_terakhir', 'profesi', 'kewenegaraan', 'nama_penanggung_jawab', 'is_penanggung_jawab', 'hubungan_dengan_pasien', 'no_telp', 'rt', 'rw', 'anak_keberapa', 'nama_ayah', 'nama_ibu', 'tempat_lahir', 'tanggal_lahir', 'status_pasien', 'foto', 'foto_ktp', 'status_pekerjaan', 'crt', 'upd'], 'safe'],
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
        $query = Pasien::find();

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
            'id_patient' => $this->id_patient,
            'kel' => $this->kel,
            'kec' => $this->kec,
            'kab' => $this->kab,
            'cara_pembayaran' => $this->cara_pembayaran,
            'crt_by' => $this->crt_by,
            'tanggal_lahir' => $this->tanggal_lahir,
            'crt' => $this->crt,
            'upd' => $this->upd,
        ]);

        $query->andFilterWhere(['like', 'no_identitas', $this->no_identitas])
            ->andFilterWhere(['like', 'no_rekam_medik', $this->no_rekam_medik])
            ->andFilterWhere(['like', 'no_kepesertaan', $this->no_kepesertaan])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'alamat_lengkap', $this->alamat_lengkap])
            ->andFilterWhere(['like', 'no_tlp_pasien', $this->no_tlp_pasien])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'status_perkawinan', $this->status_perkawinan])
            ->andFilterWhere(['like', 'pendidikan_terakhir', $this->pendidikan_terakhir])
            ->andFilterWhere(['like', 'pekerjaan_terakhir', $this->pekerjaan_terakhir])
            ->andFilterWhere(['like', 'profesi', $this->profesi])
            ->andFilterWhere(['like', 'kewenegaraan', $this->kewenegaraan])
            ->andFilterWhere(['like', 'nama_penanggung_jawab', $this->nama_penanggung_jawab])
            ->andFilterWhere(['like', 'is_penanggung_jawab', $this->is_penanggung_jawab])
            ->andFilterWhere(['like', 'hubungan_dengan_pasien', $this->hubungan_dengan_pasien])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'rw', $this->rw])
            ->andFilterWhere(['like', 'anak_keberapa', $this->anak_keberapa])
            ->andFilterWhere(['like', 'nama_ayah', $this->nama_ayah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'status_pasien', $this->status_pasien])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'foto_ktp', $this->foto_ktp])
            ->andFilterWhere(['like', 'status_pekerjaan', $this->status_pekerjaan]);

        return $dataProvider;
    }
}
