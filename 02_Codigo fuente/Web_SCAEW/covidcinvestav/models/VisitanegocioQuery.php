<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Visitanegocio]].
 *
 * @see Visitanegocio
 */
class VisitanegocioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Visitanegocio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Visitanegocio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
