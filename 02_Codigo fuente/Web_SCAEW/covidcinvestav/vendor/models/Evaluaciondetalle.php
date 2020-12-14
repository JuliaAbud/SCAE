<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluaciondetalle".
 *
 * @property int $idevaluacion_detalle
 * @property int $idevaluacion
 * @property int $idpregunta
 *
 * @property Evaluacion $evaluacion
 * @property Pregunta $pregunta
 * @property Respuesta[] $respuestas
 */
class Evaluaciondetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluaciondetalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevaluacion', 'idpregunta'], 'integer'],
            [['idevaluacion'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluacion::className(), 'targetAttribute' => ['idevaluacion' => 'idevaluacion']],
            [['idpregunta'], 'exist', 'skipOnError' => true, 'targetClass' => Pregunta::className(), 'targetAttribute' => ['idpregunta' => 'idpregunta']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevaluacion_detalle' => 'Idevaluacion Detalle',
            'idevaluacion' => 'Evaluacion',
            'idpregunta' => 'Pregunta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacion()
    {
        return $this->hasOne(Evaluacion::className(), ['idevaluacion' => 'idevaluacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['idpregunta' => 'idpregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['idevaluacion_detalle' => 'idevaluacion_detalle']);
    }
}
