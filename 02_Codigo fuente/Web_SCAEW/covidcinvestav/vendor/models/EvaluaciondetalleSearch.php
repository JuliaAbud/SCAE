<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Evaluaciondetalle;

/**
 * EvaluaciondetalleSearch represents the model behind the search form of `app\models\Evaluaciondetalle`.
 */
class EvaluaciondetalleSearch extends Evaluaciondetalle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevaluacion_detalle', 'idevaluacion', 'idpregunta'], 'integer'],
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
        $query = Evaluaciondetalle::find();

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
            'idevaluacion_detalle' => $this->idevaluacion_detalle,
            'idevaluacion' => $this->idevaluacion,
            'idpregunta' => $this->idpregunta,
        ]);

        return $dataProvider;
    }
}
