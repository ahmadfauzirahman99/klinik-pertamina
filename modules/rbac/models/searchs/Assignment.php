<?php

namespace app\modules\rbac\models\searchs;

use app\models\pegawai\Pegawai;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * AssignmentSearch represents the model behind the search form about Assignment.
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Assignment extends Model
{
    public $id;
    public $username;
    public $nama_lengkap;
    public $nama;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'safe'],
            ['nama_lengkap', 'safe'],
            ['nama', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'username' => Yii::t('rbac-admin', 'Username'),
            'name' => Yii::t('rbac-admin', 'Name'),
            'nama' => 'Nama Pegawai',
            'nama_lengkap' => 'Nama Pegawai',
        ];
    }

    /**
     * Create data provider for Assignment model.
     * @param  array                        $params
     * @param  \yii\db\ActiveRecord         $class
     * @param  string                       $usernameField
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $class, $usernameField)
    {
        $query = $class::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', $usernameField, $this->username]);
        $query->andFilterWhere(['ilike', 'nama', $this->nama]);
        // if ($this->nama_lengkap) {
        //     $pegawai = Pegawai::find()
        //         ->select([
        //             'id_nip_nrp'
        //         ])
        //         ->where(['ilike', 'nama_lengkap', $this->nama_lengkap])
        //         ->asArray()
        //         ->all();
        //     $usernamePegawai = ArrayHelper::getColumn($pegawai, 'id_nip_nrp');

        //     // echo "<pre>";
        //     // print_r($pegawai);
        //     // echo "</pre>";
        //     // die;
        //     // echo 'heloo';
        //     $query->andFilterWhere(['in', 'username', $usernamePegawai]);
        // }

        return $dataProvider;
    }
}
