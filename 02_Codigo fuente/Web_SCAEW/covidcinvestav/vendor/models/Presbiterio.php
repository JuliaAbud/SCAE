<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "presbiterio".
 *
 * @property int $idpresbiterio
 * @property string $nombre
 * @property string $prebitero
 * @property int $iddistrito
 *
 * @property Iglesia $iglesia
 * @property Distrito $distrito
 */
class Presbiterio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'presbiterio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddistrito'], 'required'],
            [['iddistrito'], 'integer'],
            [['nombre', 'prebitero'], 'string', 'max' => 100],
            [['iddistrito'], 'exist', 'skipOnError' => true, 'targetClass' => Distrito::className(), 'targetAttribute' => ['iddistrito' => 'iddistrito']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpresbiterio' => Yii::t('app', 'Idpresbiterio'),
            'nombre' => Yii::t('app', 'Nombre'),
            'prebitero' => Yii::t('app', 'Prebitero'),
            'iddistrito' => Yii::t('app', 'Distrito'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIglesia()
    {
        return $this->hasOne(Iglesia::className(), ['idiglesia' => 'idpresbiterio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrito()
    {
        return $this->hasOne(Distrito::className(), ['iddistrito' => 'iddistrito']);
    }
}
