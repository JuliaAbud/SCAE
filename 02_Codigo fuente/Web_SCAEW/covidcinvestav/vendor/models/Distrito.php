<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distrito".
 *
 * @property int $iddistrito
 * @property string $nombre
 * @property string $obispo
 * @property string $col_oficina
 * @property string $calle_oficina
 * @property string $numero_oficina
 * @property string $cp_oficina
 * @property string $municipio_oficina
 * @property string $estado_oficina
 *
 * @property Presbiterio[] $presbiterios
 */
class Distrito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distrito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'obispo'], 'string'],
            [['col_oficina', 'calle_oficina', 'numero_oficina', 'cp_oficina', 'municipio_oficina', 'estado_oficina'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddistrito' => 'Iddistrito',
            'nombre' => 'Nombre',
            'obispo' => 'Obispo',
            'col_oficina' => 'Col Oficina',
            'calle_oficina' => 'Calle Oficina',
            'numero_oficina' => 'Numero Oficina',
            'cp_oficina' => 'Cp Oficina',
            'municipio_oficina' => 'Municipio Oficina',
            'estado_oficina' => 'Estado Oficina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresbiterios()
    {
        return $this->hasMany(Presbiterio::className(), ['iddistrito' => 'iddistrito']);
    }
}
