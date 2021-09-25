<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Satuan]].
 *
 * @see Satuan
 */
class SatuanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Satuan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Satuan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function select2()
    {
        $result = $this->all();
        return ArrayHelper::map($result, 'id_satuan', 'nama_satuan');
    }
}
