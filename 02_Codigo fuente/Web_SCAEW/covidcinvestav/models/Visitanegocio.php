<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visitanegocio".
 *
 * @property int $idvisita
 * @property int $idnegocio
 * @property string $fecha
 * @property string $hora
 * @property int $concurrencia
 */
class Visitanegocio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visitanegocio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvisita', 'idnegocio','concurrencia'], 'integer'],
            [['fecha', 'hora' ], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvisita' => Yii::t('app', 'Idvisita'),
            'idnegocio' => Yii::t('app', 'Idnegocio'),
            'fecha' => Yii::t('app', 'Fecha'),
            'hora' => Yii::t('app', 'Hora'),
            'concurrencia' => Yii::t('app', 'Concurrencia'),
        ];
    }

    /**
     * @inheritdoc
     * @return VisitanegocioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitanegocioQuery(get_called_class());
    }
}
