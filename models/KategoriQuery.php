<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Kategori]].
 *
 * @see Kategori
 */
class KategoriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Kategori[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Kategori|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
