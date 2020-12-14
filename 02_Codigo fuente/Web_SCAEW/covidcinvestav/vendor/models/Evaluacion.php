<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluacion".
 *
 * @property int $idevaluacion
 * @property string $fecha_limite
 * @property string $descripcion
 * @property string $cuatrimestre
 * @property string $estado
 *
 * @property Evaluaciondetalle[] $evaluaciondetalles
 */
class Evaluacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_limite'], 'safe'],
            [['cuatrimestre', 'estado'], 'string'],
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevaluacion' => 'Idevaluacion',
            'fecha_limite' => 'Fecha Limite',
            'descripcion' => 'Descripcion',
            'cuatrimestre' => 'Cuatrimestre',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluaciondetalles()
    {
        return $this->hasMany(Evaluaciondetalle::className(), ['idevaluacion' => 'idevaluacion']);
    }
}
