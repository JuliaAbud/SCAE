<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Negocio;

/**
 * NegocioSearch represents the model behind the search form of `app\models\Negocio`.
 */
class NegocioSearch extends Negocio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnegocio', 'aforo', 'idmunicipio', 'idrubro', 'idusers'], 'integer'],
            [['codigo', 'nombre', 'descripcion', 'calle', 'numero', 'colonia', 'cp', 'latitud', 'longitud', 'fechacreacion'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Negocio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idnegocio' => $this->idnegocio,
            'aforo' => $this->aforo,
            'fechacreacion' => $this->fechacreacion,
            'idmunicipio' => $this->idmunicipio,
            'idrubro' => $this->idrubro,
            'idusers' => $this->idusers,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'cp', $this->cp])
            ->andFilterWhere(['like', 'latitud', $this->latitud])
            ->andFilterWhere(['like', 'longitud', $this->longitud]);

        return $dataProvider;
    }
}
