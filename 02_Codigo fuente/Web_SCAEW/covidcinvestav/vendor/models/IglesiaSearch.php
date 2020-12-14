<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Iglesia;

/**
 * IglesiaSearch represents the model behind the search form of `app\models\Iglesia`.
 */
class IglesiaSearch extends Iglesia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idiglesia', 'idpresbiterio'], 'integer'],
            [['nombre', 'pastor', 'fecha_nacimiento', 'estado_civil', 'col_pastor', 'calle_pastor', 'numero_pastor', 'correo_pastor', 'tel_pastor', 'col_templo', 'calle_templo', 'numero_templo', 'cp_templo', 'municipio_templo', 'estado_templo', 'col_pastoral', 'calle_pastoral', 'numero_pastoral', 'cp_pastoral', 'municipio_pastoral', 'estado_pastoral', 'domicilio_correspondencia', 'pagina_web'], 'safe'],
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
        $query = Iglesia::find();

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
            'idiglesia' => $this->idiglesia,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'idpresbiterio' => $this->idpresbiterio,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'pastor', $this->pastor])
            ->andFilterWhere(['like', 'estado_civil', $this->estado_civil])
            ->andFilterWhere(['like', 'col_pastor', $this->col_pastor])
            ->andFilterWhere(['like', 'calle_pastor', $this->calle_pastor])
            ->andFilterWhere(['like', 'numero_pastor', $this->numero_pastor])
            ->andFilterWhere(['like', 'correo_pastor', $this->correo_pastor])
            ->andFilterWhere(['like', 'tel_pastor', $this->tel_pastor])
            ->andFilterWhere(['like', 'col_templo', $this->col_templo])
            ->andFilterWhere(['like', 'calle_templo', $this->calle_templo])
            ->andFilterWhere(['like', 'numero_templo', $this->numero_templo])
            ->andFilterWhere(['like', 'cp_templo', $this->cp_templo])
            ->andFilterWhere(['like', 'municipio_templo', $this->municipio_templo])
            ->andFilterWhere(['like', 'estado_templo', $this->estado_templo])
            ->andFilterWhere(['like', 'col_pastoral', $this->col_pastoral])
            ->andFilterWhere(['like', 'calle_pastoral', $this->calle_pastoral])
            ->andFilterWhere(['like', 'numero_pastoral', $this->numero_pastoral])
            ->andFilterWhere(['like', 'cp_pastoral', $this->cp_pastoral])
            ->andFilterWhere(['like', 'municipio_pastoral', $this->municipio_pastoral])
            ->andFilterWhere(['like', 'estado_pastoral', $this->estado_pastoral])
            ->andFilterWhere(['like', 'domicilio_correspondencia', $this->domicilio_correspondencia])
            ->andFilterWhere(['like', 'pagina_web', $this->pagina_web]);

        return $dataProvider;
    }
}
