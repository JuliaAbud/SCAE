<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Visita]].
 *
 * @see Visita
 */
class VisitaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Visita[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Visita|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
