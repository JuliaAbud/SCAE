<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "individuo".
 *
 * @property int $idindividuo
 * @property string $codigo
 * @property string $fechacreacion
 */
class Individuo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'individuo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechacreacion'], 'safe'],
            [['codigo'], 'string', 'max' => 90],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idindividuo' => Yii::t('app', 'Idindividuo'),
            'codigo' => Yii::t('app', 'Codigo'),
            'fechacreacion' => Yii::t('app', 'Fechacreacion'),
        ];
    }

    /**
     * @inheritdoc
     * @return IndividuoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IndividuoQuery(get_called_class());
    }
}
