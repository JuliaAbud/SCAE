<?php

namespace app\models;

use Yii;
use app\models\Visita;

/**
 * This is the model class for table "negocio".
 *
 * @property int $idnegocio
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property int $aforo
 * @property string $calle
 * @property string $numero
 * @property string $colonia
 * @property string $cp
 * @property string $latitud
 * @property string $longitud
 * @property string $fechacreacion
 * @property int $idmunicipio
 * @property int $idrubro
 * @property int $idusers
 *
 * @property Municipio $municipio
 * @property Rubro $rubro
 * @property Users $users
 * @property Visita[] $visitas
 */
class Negocio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'negocio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aforo', 'idmunicipio', 'idrubro', 'idusers','idnegocio'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['idrubro', 'idusers'], 'required'],
            [['codigo', 'calle', 'colonia'], 'string', 'max' => 90],
            [['nombre', 'descripcion'], 'string', 'max' => 150],
            [['numero', 'cp'], 'string', 'max' => 10],
            [['latitud', 'longitud'], 'string', 'max' => 20],
            [['codigo'], 'unique'],
			[['email'], 'string', 'max' => 80],
            [['idmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunicipio' => 'idmunicipio']],
            [['idrubro'], 'exist', 'skipOnError' => true, 'targetClass' => Rubro::className(), 'targetAttribute' => ['idrubro' => 'idrubro']],
            [['idusers'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['idusers' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnegocio' => Yii::t('app', 'Idnegocio'),
            'codigo' => Yii::t('app', 'Código'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripción'),
            'aforo' => Yii::t('app', 'Aforo Max'),
            'calle' => Yii::t('app', 'Calle'),
            'numero' => Yii::t('app', 'Número'),
            'colonia' => Yii::t('app', 'Colonia'),
            'cp' => Yii::t('app', 'Cp'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
            'fechacreacion' => Yii::t('app', 'Fechacreación'),
            'idmunicipio' => Yii::t('app', 'Idmunicipio'),
            'idrubro' => Yii::t('app', 'Idrubro'),
            'idusers' => Yii::t('app', 'Idusers'),
			 'concurrencia' => Yii::t('app', 'Concurrencia Actual'),
			  'email' => Yii::t('app', 'Correo'),
			   'tiempopermanencia' => Yii::t('app', 'Tiempo permanencia(min)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'idmunicipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubro()
    {
        return $this->hasOne(Rubro::className(), ['idrubro' => 'idrubro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'idusers']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitas()
    {
        return $this->hasMany(Visita::className(), ['idnegocio' => 'idnegocio']);
    }
	public function getConcurrencia()
    {
        $tablevisitas= new visita;
		$query = "SELECT count(*) as idvisita FROM visita v inner join negocio n on v.idnegocio=n.idnegocio
		 where v.idnegocio=".$this->idnegocio." and now() between v.fechavisita 
		 and  DATE_ADD(v.fechavisita, INTERVAL n.tiempopermanencia MINUTE)";
		$concurrencia = $tablevisitas->findBySql($query)->one();

		return $concurrencia->idvisita;
    }

    /**
     * @inheritdoc
     * @return NegocioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NegocioQuery(get_called_class());
    }
}
