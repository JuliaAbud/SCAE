<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Biometrico]].
 *
 * @see Biometrico
 */
class BiometricoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Biometrico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Biometrico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
