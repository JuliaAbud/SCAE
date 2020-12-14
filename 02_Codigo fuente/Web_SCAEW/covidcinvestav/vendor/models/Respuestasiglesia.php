<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuestasiglesia".
 *
 * @property string $idrespuestasiglesias
 * @property int $idevaluacion
 * @property int $idevaluacion_detalle
 * @property int $idpregunta
 * @property int $idrubro
 * @property int $idrespuesta
 * @property int $idiglesia
 * @property int $idpresbiterio
 * @property int $iddistrito
 * @property string $fecha_limite
 * @property string $evaluacion
 * @property string $pregunta
 * @property string $tipo_dato
 * @property string $rubro
 * @property string $respuesta
 * @property string $iglesia
 * @property string $presbiterio
 * @property string $distrito
 */
class Respuestasiglesia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuestasiglesia';
    }
 public static function primaryKey()
        {
            return array('idrespuestasiglesias');
        }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevaluacion', 'idevaluacion_detalle', 'idpregunta', 'idrubro', 'idrespuesta', 'idiglesia', 'idpresbiterio', 'iddistrito'], 'integer'],
            [['fecha_limite'], 'safe'],
            [['tipo_dato'], 'string'],
            [['idrespuestasiglesias'], 'string', 'max' => 23],
            [['evaluacion'], 'string', 'max' => 45],
            [['pregunta'], 'string', 'max' => 450],
            [['rubro', 'iglesia', 'presbiterio', 'distrito'], 'string', 'max' => 100],
            [['respuesta'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrespuestasiglesias' => Yii::t('app', 'Idrespuestasiglesias'),
            'idevaluacion' => Yii::t('app', 'Idevaluacion'),
            'idevaluacion_detalle' => Yii::t('app', 'Idevaluacion Detalle'),
            'idpregunta' => Yii::t('app', 'Idpregunta'),
            'idrubro' => Yii::t('app', 'Idrubro'),
            'idrespuesta' => Yii::t('app', 'Idrespuesta'),
            'idiglesia' => Yii::t('app', 'Idiglesia'),
            'idpresbiterio' => Yii::t('app', 'Idpresbiterio'),
            'iddistrito' => Yii::t('app', 'Iddistrito'),
            'fecha_limite' => Yii::t('app', 'Fecha Limite'),
            'evaluacion' => Yii::t('app', 'Evaluacion'),
            'pregunta' => Yii::t('app', 'Pregunta'),
            'tipo_dato' => Yii::t('app', 'Tipo Dato'),
            'rubro' => Yii::t('app', 'Rubro'),
            'respuesta' => Yii::t('app', 'Respuesta'),
            'iglesia' => Yii::t('app', 'Iglesia'),
            'presbiterio' => Yii::t('app', 'Presbiterio'),
            'distrito' => Yii::t('app', 'Distrito'),
        ];
    }
}
