<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cuestionario;

/**
 * CuestionarioSearch represents the model behind the search form of `app\models\Cuestionario`.
 */
class CuestionarioSearch extends Cuestionario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idevaluacion', 'idevaluacion_detalle', 'idpregunta', 'idrubro'], 'integer'],
            [['idcuestionario', 'fecha_limite', 'evaluacion', 'pregunta', 'tipo_dato', 'rubro'], 'safe'],
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
        $query = Cuestionario::find();

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
            'idevaluacion' => $this->idevaluacion,
            'idevaluacion_detalle' => $this->idevaluacion_detalle,
            'idpregunta' => $this->idpregunta,
            'idrubro' => $this->idrubro,
            'fecha_limite' => $this->fecha_limite,
        ]);

        $query->andFilterWhere(['like', 'idcuestionario', $this->idcuestionario])
            ->andFilterWhere(['like', 'evaluacion', $this->evaluacion])
            ->andFilterWhere(['like', 'pregunta', $this->pregunta])
            ->andFilterWhere(['like', 'tipo_dato', $this->tipo_dato])
            ->andFilterWhere(['like', 'rubro', $this->rubro]);

        return $dataProvider;
    }
}
