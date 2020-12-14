<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Respuestasiglesia;

/**
 * RespuestasiglesiaSearch represents the model behind the search form of `app\models\Respuestasiglesia`.
 */
class RespuestasiglesiaSearch extends Respuestasiglesia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrespuestasiglesias', 'fecha_limite', 'evaluacion', 'pregunta', 'tipo_dato', 'rubro', 'respuesta', 'iglesia', 'presbiterio', 'distrito'], 'safe'],
            [['idevaluacion', 'idevaluacion_detalle', 'idpregunta', 'idrubro', 'idrespuesta', 'idiglesia', 'idpresbiterio', 'iddistrito'], 'integer'],
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
        $query = Respuestasiglesia::find();

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
            'idrespuesta' => $this->idrespuesta,
            'idiglesia' => $this->idiglesia,
            'idpresbiterio' => $this->idpresbiterio,
            'iddistrito' => $this->iddistrito,
            'fecha_limite' => $this->fecha_limite,
        ]);

        $query->andFilterWhere(['like', 'idrespuestasiglesias', $this->idrespuestasiglesias])
            ->andFilterWhere(['like', 'evaluacion', $this->evaluacion])
            ->andFilterWhere(['like', 'pregunta', $this->pregunta])
            ->andFilterWhere(['like', 'tipo_dato', $this->tipo_dato])
            ->andFilterWhere(['like', 'rubro', $this->rubro])
            ->andFilterWhere(['like', 'respuesta', $this->respuesta])
            ->andFilterWhere(['like', 'iglesia', $this->iglesia])
            ->andFilterWhere(['like', 'presbiterio', $this->presbiterio])
            ->andFilterWhere(['like', 'distrito', $this->distrito]);

        return $dataProvider;
    }
}
