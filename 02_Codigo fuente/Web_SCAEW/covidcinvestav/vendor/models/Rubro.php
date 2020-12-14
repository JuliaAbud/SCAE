<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rubro".
 *
 * @property int $idrubro
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Pregunta[] $preguntas
 */
class Rubro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrubro' => 'Idrubro',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['idrubro' => 'idrubro']);
    }
}
