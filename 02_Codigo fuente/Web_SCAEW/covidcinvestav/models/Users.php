<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $activate
 *
 * @property Negocio[] $negocios
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propietario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','name', 'password', 'authKey', 'accessToken'], 'required'],
            [['activate'], 'integer'],
            [['username'], 'string', 'max' => 16],
            [['email'], 'string', 'max' => 80],
			[['name'], 'string', 'max' => 100],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 250],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
			'name' => Yii::t('app', 'nombre'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'activate' => Yii::t('app', 'Activate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNegocios()
    {
        return $this->hasMany(Negocio::className(), ['idusers' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
