<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Dokter]].
 *
 * @see Dokter
 */
class DokterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dokter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dokter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function select2()
    {
        $result = $this
            ->select([
                'id_dokter',
                'concat(gelar_depan, " ", nama_dokter, " ", gelar_belakang) as nama_dokter'
            ])
            ->all();
        return ArrayHelper::map($result, 'id_dokter', 'nama_dokter');
    }
}
