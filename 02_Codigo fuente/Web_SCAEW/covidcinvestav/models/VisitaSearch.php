<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Visita;

/**
 * VisitaSearch represents the model behind the search form of `app\models\Visita`.
 */
class VisitaSearch extends Visita
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvisita', 'idnegocio'], 'integer'],
            [['codigoindividuo', 'fechavisita', 'temperatura'], 'safe'],
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
        $query = Visita::find();

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
            'idvisita' => $this->idvisita,
            'idnegocio' => $this->idnegocio,
            'fechavisita' => $this->fechavisita,
        ]);

        $query->andFilterWhere(['like', 'codigoindividuo', $this->codigoindividuo])
            ->andFilterWhere(['like', 'temperatura', $this->temperatura]);

        return $dataProvider;
    }
}
