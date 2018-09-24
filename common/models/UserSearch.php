<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['nome', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'created_at', 'updated_at', 'visualizacao_candidatos', 'visualizacao_candidatos_finalizados', 'visualizacao_cartas_respondidas', 'administrador', 'coordenador', 'secretaria', 'professor', 'aluno', 'telcelular'], 'safe'],
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
        $query = User::find()->where(['status' => '10'])->orderBy('nome ASC');

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
            'id' => $this->id,
            'status' => $this->status,
            'visualizacao_candidatos' => $this->visualizacao_candidatos,
            'visualizacao_candidatos_finalizados' => $this->visualizacao_candidatos_finalizados,
            'visualizacao_cartas_respondidas' => $this->visualizacao_cartas_respondidas,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'administrador', $this->administrador])
            ->andFilterWhere(['like', 'coordenador', $this->coordenador])
            ->andFilterWhere(['like', 'secretaria', $this->secretaria])
            ->andFilterWhere(['like', 'professor', $this->professor])
            ->andFilterWhere(['like', 'aluno', $this->aluno]);

        return $dataProvider;
    }
}
