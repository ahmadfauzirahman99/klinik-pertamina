<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Dosis]].
 *
 * @see Dosis
 */
class DosisQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dosis[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dosis|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
