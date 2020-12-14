<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biometrico".
 *
 * @property int $idbiometrico
 * @property int $idvisita
 * @property string $tipo
 * @property string $valor
 *
 * @property Visita $visita
 */
class Biometrico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'biometrico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvisita'], 'required'],
            [['idvisita'], 'integer'],
            [['tipo'], 'string'],
            [['valor'], 'string', 'max' => 10],
            [['idvisita'], 'exist', 'skipOnError' => true, 'targetClass' => Visita::className(), 'targetAttribute' => ['idvisita' => 'idvisita']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbiometrico' => Yii::t('app', 'Idbiometrico'),
            'idvisita' => Yii::t('app', 'Idvisita'),
            'tipo' => Yii::t('app', 'Tipo'),
            'valor' => Yii::t('app', 'Valor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisita()
    {
        return $this->hasOne(Visita::className(), ['idvisita' => 'idvisita']);
    }

    /**
     * @inheritdoc
     * @return BiometricoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BiometricoQuery(get_called_class());
    }
}
