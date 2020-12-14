<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "iglesia".
 *
 * @property int $idiglesia
 * @property string $nombre
 * @property string $pastor
 * @property string $fecha_nacimiento
 * @property string $estado_civil
 * @property string $col_pastor
 * @property string $calle_pastor
 * @property string $numero_pastor
 * @property string $correo_pastor
 * @property string $tel_pastor
 * @property string $col_templo
 * @property string $calle_templo
 * @property string $numero_templo
 * @property string $cp_templo
 * @property string $municipio_templo
 * @property string $estado_templo
 * @property string $col_pastoral
 * @property string $calle_pastoral
 * @property string $numero_pastoral
 * @property string $cp_pastoral
 * @property string $municipio_pastoral
 * @property string $estado_pastoral
 * @property string $domicilio_correspondencia
 * @property string $pagina_web
 * @property int $idpresbiterio
 *
 * @property Presbiterio $presbiterio
 * @property Respuesta[] $respuestas
 */
class Iglesia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iglesia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_nacimiento'], 'safe'],
            [['domicilio_correspondencia', 'pagina_web'], 'string'],
            [['idpresbiterio'], 'integer'],
            [['nombre', 'pastor'], 'string', 'max' => 100],
            [['estado_civil'], 'string', 'max' => 50],
            [['col_pastor', 'calle_pastor', 'numero_pastor', 'correo_pastor', 'tel_pastor', 'col_templo', 'calle_templo', 'numero_templo', 'cp_templo', 'municipio_templo', 'estado_templo', 'col_pastoral', 'calle_pastoral', 'numero_pastoral', 'cp_pastoral', 'municipio_pastoral', 'estado_pastoral'], 'string', 'max' => 300],
            [['idpresbiterio'], 'exist', 'skipOnError' => true, 'targetClass' => Presbiterio::className(), 'targetAttribute' => ['idpresbiterio' => 'idpresbiterio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idiglesia' => Yii::t('app', 'Idiglesia'),
            'nombre' => Yii::t('app', 'Nombre'),
            'pastor' => Yii::t('app', 'Pastor'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha de Nacimiento'),
            'estado_civil' => Yii::t('app', 'Estado Civil'),
            'col_pastor' => Yii::t('app', 'Col Pastor'),
            'calle_pastor' => Yii::t('app', 'Direccion del pastor'),
            'numero_pastor' => Yii::t('app', 'Numero del casa Pastor'),
            'correo_pastor' => Yii::t('app', 'Correo electronico'),
            'tel_pastor' => Yii::t('app', 'Telefono'),
            'col_templo' => Yii::t('app', 'Colonia del templo'),
            'calle_templo' => Yii::t('app', 'Calle del templo'),
            'numero_templo' => Yii::t('app', 'Numero del templo'),
            'cp_templo' => Yii::t('app', 'CP Templo'),
            'municipio_templo' => Yii::t('app', 'Municipio del templo'),
            'estado_templo' => Yii::t('app', 'Estado del emplo'),
            'col_pastoral' => Yii::t('app', 'Colonia  casa pastoral'),
            'calle_pastoral' => Yii::t('app', 'Calle casa pastoral'),
            'numero_pastoral' => Yii::t('app', 'Numero casa pastoral'),
            'cp_pastoral' => Yii::t('app', 'CP Pastoral'),
            'municipio_pastoral' => Yii::t('app', 'Municipio pastoral'),
            'estado_pastoral' => Yii::t('app', 'Estado pastoral'),
            'domicilio_correspondencia' => Yii::t('app', 'Domicilio para envio de correspondencia'),
            'pagina_web' => Yii::t('app', 'Pagina Web'),
            'idpresbiterio' => Yii::t('app', 'Presbiterio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresbiterio()
    {
        return $this->hasOne(Presbiterio::className(), ['idpresbiterio' => 'idpresbiterio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['idiglesia' => 'idiglesia']);
    }
}
