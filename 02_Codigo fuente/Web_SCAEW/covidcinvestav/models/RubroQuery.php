<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Rubro]].
 *
 * @see Rubro
 */
class RubroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Rubro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rubro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
