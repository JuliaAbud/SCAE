<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Negocioaux;

/**
 * NegocioauxSearch represents the model behind the search form of `app\models\Negocioaux`.
 */
class NegocioauxSearch extends Negocioaux
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnegocioaux', 'aforo', 'tiempopermanencia', 'idmunicipio', 'idrubro', 'idusers'], 'integer'],
            [['codigo', 'nombre', 'codigoactividad', 'calle', 'numero', 'colonia', 'entidad', 'municipio', 'cp', 'latitud', 'longitud', 'email'], 'safe'],
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
        $query = Negocioaux::find();

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
            'idnegocioaux' => $this->idnegocioaux,
            'aforo' => $this->aforo,
            'tiempopermanencia' => $this->tiempopermanencia,
            'idmunicipio' => $this->idmunicipio,
            'idrubro' => $this->idrubro,
            'idusers' => $this->idusers,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'codigoactividad', $this->codigoactividad])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'entidad', $this->entidad])
            ->andFilterWhere(['like', 'municipio', $this->municipio])
            ->andFilterWhere(['like', 'cp', $this->cp])
            ->andFilterWhere(['like', 'latitud', $this->latitud])
            ->andFilterWhere(['like', 'longitud', $this->longitud])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
