<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visita".
 *
 * @property int $idvisita
 * @property string $codigoindividuo
 * @property int $idnegocio
 * @property string $fechavisita
 * @property string $temperatura
 *
 * @property Individuo $codigoindividuo0
 * @property Negocio $negocio
 */
class Visita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnegocio'], 'required'],
            [['idnegocio'], 'integer'],
            [['fechavisita'], 'safe'],
            [['codigoindividuo'], 'string', 'max' => 90],
            [['temperatura'], 'string', 'max' => 5],
            [['codigoindividuo'], 'exist', 'skipOnError' => true, 'targetClass' => Individuo::className(), 'targetAttribute' => ['codigoindividuo' => 'codigo']],
            [['idnegocio'], 'exist', 'skipOnError' => true, 'targetClass' => Negocio::className(), 'targetAttribute' => ['idnegocio' => 'idnegocio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvisita' => Yii::t('app', 'Idvisita'),
            'codigoindividuo' => Yii::t('app', 'Codigoindividuo'),
            'idnegocio' => Yii::t('app', 'Idnegocio'),
            'fechavisita' => Yii::t('app', 'Fechavisita'),
            'temperatura' => Yii::t('app', 'Temperatura'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoindividuo0()
    {
        return $this->hasOne(Individuo::className(), ['codigo' => 'codigoindividuo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNegocio()
    {
        return $this->hasOne(Negocio::className(), ['idnegocio' => 'idnegocio']);
    }
	 public function getTemp()
    {
        return $this->hasOne(Biometrico::className(), ['idvisita' => 'idvisita']);
    }

    /**
     * @inheritdoc
     * @return VisitaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitaQuery(get_called_class());
    }
}
