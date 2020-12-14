<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Contagio]].
 *
 * @see Contagio
 */
class ContagioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Contagio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Contagio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
