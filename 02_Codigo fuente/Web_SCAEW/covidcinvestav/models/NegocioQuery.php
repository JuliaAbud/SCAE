<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Negocio]].
 *
 * @see Negocio
 */
class NegocioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Negocio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Negocio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
