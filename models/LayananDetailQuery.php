<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LayananDetail]].
 *
 * @see LayananDetail
 */
class LayananDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LayananDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LayananDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
