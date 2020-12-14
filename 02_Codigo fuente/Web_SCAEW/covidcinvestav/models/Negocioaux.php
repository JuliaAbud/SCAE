<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "negocioaux".
 *
 * @property int $idnegocioaux
 * @property string $codigo
 * @property string $nombre
 * @property string $codigoactividad
 * @property int $aforo
 * @property int $tiempopermanencia
 * @property string $calle
 * @property string $numero
 * @property string $colonia
 * @property string $entidad
 * @property string $municipio
 * @property string $cp
 * @property string $latitud
 * @property string $longitud
 * @property int $idmunicipio
 * @property int $idrubro
 * @property int $idusers
 * @property string $email
 */
class Negocioaux extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'negocioaux';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aforo', 'tiempopermanencia', 'idmunicipio', 'idrubro', 'idusers'], 'integer'],
            [['codigo', 'calle', 'colonia', 'entidad', 'municipio'], 'string', 'max' => 90],
            [['nombre', 'codigoactividad'], 'string', 'max' => 150],
            [['numero', 'cp'], 'string', 'max' => 10],
            [['latitud', 'longitud'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnegocioaux' => Yii::t('app', 'Idnegocioaux'),
            'codigo' => Yii::t('app', 'Codigo'),
            'nombre' => Yii::t('app', 'Nombre'),
            'codigoactividad' => Yii::t('app', 'Codigoactividad'),
            'aforo' => Yii::t('app', 'Aforo'),
            'tiempopermanencia' => Yii::t('app', 'Tiempopermanencia'),
            'calle' => Yii::t('app', 'Calle'),
            'numero' => Yii::t('app', 'Numero'),
            'colonia' => Yii::t('app', 'Colonia'),
            'entidad' => Yii::t('app', 'Entidad'),
            'municipio' => Yii::t('app', 'Municipio'),
            'cp' => Yii::t('app', 'Cp'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
            'idmunicipio' => Yii::t('app', 'Idmunicipio'),
            'idrubro' => Yii::t('app', 'Idrubro'),
            'idusers' => Yii::t('app', 'Idusers'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @inheritdoc
     * @return NegocioauxQuery the active query used by this AR class.
     */
	public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'idusers']);
    }
	public function getRubro()
    {
        return $this->hasOne(Rubro::className(), ['idrubro' => 'idrubro']);
    }
    public static function find()
    {
        return new NegocioauxQuery(get_called_class());
    }
}
