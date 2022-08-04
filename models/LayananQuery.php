<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Resep]].
 *
 * @see Resep
 */
class LayananQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Resep[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Resep|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function select2Status()
    {
        $status = [
            'Dokter' => 'Dokter',
            'Perawat' => 'Perawat',
        ];
        return $status;
    }
}
