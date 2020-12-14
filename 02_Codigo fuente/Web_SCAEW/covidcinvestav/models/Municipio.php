<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property int $idmunicipio
 * @property string $nombre
 * @property string $descripcion
 * @property int $idestado
 *
 * @property Estado $estado
 * @property Negocio[] $negocios
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idestado'], 'required'],
            [['idestado'], 'integer'],
            [['nombre', 'descripcion'], 'string', 'max' => 90],
            [['idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idestado' => 'idestado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmunicipio' => Yii::t('app', 'Idmunicipio'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'idestado' => Yii::t('app', 'Idestado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'idestado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNegocios()
    {
        return $this->hasMany(Negocio::className(), ['idmunicipio' => 'idmunicipio']);
    }

    /**
     * @inheritdoc
     * @return MunicipioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MunicipioQuery(get_called_class());
    }
}
