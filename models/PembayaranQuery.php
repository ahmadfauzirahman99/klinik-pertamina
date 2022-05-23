<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Pembayaran]].
 *
 * @see Pembayaran
 */
class PembayaranQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pembayaran[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pembayaran|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
