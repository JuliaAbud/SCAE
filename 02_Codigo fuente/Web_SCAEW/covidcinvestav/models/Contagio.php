<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contagio".
 *
 * @property int $idcontagio
 * @property string $codigoindividuo
 * @property string $fechacontagio
 * @property string $fechanotificacion
 *
 * @property Individuo $codigoindividuo0
 */
class Contagio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contagio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechacontagio', 'fechanotificacion'], 'safe'],
            [['codigoindividuo'], 'string', 'max' => 90],
            [['codigoindividuo'], 'exist', 'skipOnError' => true, 'targetClass' => Individuo::className(), 'targetAttribute' => ['codigoindividuo' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcontagio' => Yii::t('app', 'Idcontagio'),
            'codigoindividuo' => Yii::t('app', 'Codigoindividuo'),
            'fechacontagio' => Yii::t('app', 'Fechacontagio'),
            'fechanotificacion' => Yii::t('app', 'Fechanotificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoindividuo0()
    {
        return $this->hasOne(Individuo::className(), ['codigo' => 'codigoindividuo']);
    }

    /**
     * @inheritdoc
     * @return ContagioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContagioQuery(get_called_class());
    }
}
