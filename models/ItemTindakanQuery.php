<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemTindakan]].
 *
 * @see ItemTindakan
 */
class ItemTindakanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ItemTindakan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemTindakan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
