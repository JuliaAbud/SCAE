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
 * @property Negocio[] $negocios
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
            [['nombre', 'descripcion'], 'string', 'max' => 90],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrubro' => Yii::t('app', 'Idrubro'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNegocios()
    {
        return $this->hasMany(Negocio::className(), ['idrubro' => 'idrubro']);
    }

    /**
     * @inheritdoc
     * @return RubroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RubroQuery(get_called_class());
    }
}
