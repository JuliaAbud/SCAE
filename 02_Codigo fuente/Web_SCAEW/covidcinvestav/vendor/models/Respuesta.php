<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta".
 *
 * @property int $idrespuesta
 * @property int $idevaluacion_detalle
 * @property int $idiglesia
 * @property string $valor
 *
 * @property Evaluaciondetalle $evaluacionDetalle
 * @property Iglesia $iglesia
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevaluacion_detalle', 'idiglesia'], 'integer'],
            [['valor'], 'string', 'max' => 500],
            [['idevaluacion_detalle'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluaciondetalle::className(), 'targetAttribute' => ['idevaluacion_detalle' => 'idevaluacion_detalle']],
            [['idiglesia'], 'exist', 'skipOnError' => true, 'targetClass' => Iglesia::className(), 'targetAttribute' => ['idiglesia' => 'idiglesia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrespuesta' => 'Idrespuesta',
            'idevaluacion_detalle' => 'Idevaluacion Detalle',
            'idiglesia' => 'Idiglesia',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionDetalle()
    {
        return $this->hasOne(Evaluaciondetalle::className(), ['idevaluacion_detalle' => 'idevaluacion_detalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIglesia()
    {
        return $this->hasOne(Iglesia::className(), ['idiglesia' => 'idiglesia']);
    }
}
