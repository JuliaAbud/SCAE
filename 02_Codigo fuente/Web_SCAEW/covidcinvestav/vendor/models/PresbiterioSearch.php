<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presbiterio;

/**
 * PresbiterioSearch represents the model behind the search form of `app\models\Presbiterio`.
 */
class PresbiterioSearch extends Presbiterio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idpresbiterio', 'iddistrito'], 'integer'],
            [['nombre', 'prebitero'], 'safe'],
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
        $query = Presbiterio::find();

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
            'idpresbiterio' => $this->idpresbiterio,
            'iddistrito' => $this->iddistrito,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'prebitero', $this->prebitero]);

        return $dataProvider;
    }
}
