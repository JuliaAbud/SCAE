<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Distrito;

/**
 * DistritoSearch represents the model behind the search form of `app\models\Distrito`.
 */
class DistritoSearch extends Distrito
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddistrito'], 'integer'],
            [['nombre', 'obispo', 'col_oficina', 'calle_oficina', 'numero_oficina', 'cp_oficina', 'municipio_oficina', 'estado_oficina'], 'safe'],
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
        $query = Distrito::find();

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
            'iddistrito' => $this->iddistrito,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'obispo', $this->obispo])
            ->andFilterWhere(['like', 'col_oficina', $this->col_oficina])
            ->andFilterWhere(['like', 'calle_oficina', $this->calle_oficina])
            ->andFilterWhere(['like', 'numero_oficina', $this->numero_oficina])
            ->andFilterWhere(['like', 'cp_oficina', $this->cp_oficina])
            ->andFilterWhere(['like', 'municipio_oficina', $this->municipio_oficina])
            ->andFilterWhere(['like', 'estado_oficina', $this->estado_oficina]);

        return $dataProvider;
    }
}
