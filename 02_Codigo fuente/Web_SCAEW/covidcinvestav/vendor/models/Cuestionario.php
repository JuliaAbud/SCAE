<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuestionario".
 *
 * @property int $idevaluacion
 * @property string $idcuestionario
 * @property int $idevaluacion_detalle
 * @property int $idpregunta
 * @property int $idrubro
 * @property string $fecha_limite
 * @property string $evaluacion
 * @property string $pregunta
 * @property string $tipo_dato
 * @property string $rubro
 */
class Cuestionario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuestionario';
    }

    public static function primaryKey()
        {
            return array('idcuestionario');
        }
    public function rules()
    {
        return [
            [['idevaluacion', 'idevaluacion_detalle', 'idpregunta', 'idrubro'], 'integer'],
            [['fecha_limite'], 'safe'],
            [['tipo_dato'], 'string'],
            [['idcuestionario'], 'string', 'max' => 23],
            [['evaluacion'], 'string', 'max' => 45],
            [['pregunta'], 'string', 'max' => 450],
            [['rubro'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevaluacion' => Yii::t('app', 'Idevaluacion'),
            'idcuestionario' => Yii::t('app', 'Idcuestionario'),
            'idevaluacion_detalle' => Yii::t('app', 'Idevaluacion Detalle'),
            'idpregunta' => Yii::t('app', 'Idpregunta'),
            'idrubro' => Yii::t('app', 'Idrubro'),
            'fecha_limite' => Yii::t('app', 'Fecha Limite'),
            'evaluacion' => Yii::t('app', 'Evaluacion'),
            'pregunta' => Yii::t('app', 'Pregunta'),
            'tipo_dato' => Yii::t('app', 'Tipo Dato'),
            'rubro' => Yii::t('app', 'Rubro'),
        ];
    }
}
