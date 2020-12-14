<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property int $idpregunta
 * @property string $texto
 * @property string $valor
 * @property int $idrubro
 *
 * @property Evaluaciondetalle[] $evaluaciondetalles
 * @property Rubro $rubro
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor'], 'string'],
            [['idrubro'], 'integer'],
            [['texto'], 'string', 'max' => 450],
            [['idrubro'], 'exist', 'skipOnError' => true, 'targetClass' => Rubro::className(), 'targetAttribute' => ['idrubro' => 'idrubro']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpregunta' => 'Idpregunta',
            'texto' => 'Texto',
            'valor' => 'Valor',
            'idrubro' => 'Rubro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluaciondetalles()
    {
        return $this->hasMany(Evaluaciondetalle::className(), ['idpregunta' => 'idpregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubro()
    {
        return $this->hasOne(Rubro::className(), ['idrubro' => 'idrubro']);
    }
}
