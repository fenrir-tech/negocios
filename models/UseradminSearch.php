<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Useradmin;

class UseradminSearch extends Useradmin
{
    public function rules()
    {
        return [
            [['id', 'updated_at', 'created_at', 'status', 'location_id', 'department_id', 'can_admin', 'can_visits', 'can_productivity', 'can_requestresources', 'can_managervisits', 'can_managerproductivity', 'can_managerrequestresources'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'avatar', 'fullname', 'phone', 'celphone', 'birthdate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Useradmin::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC, 
                ]
            ],
            'pagination' => [
                'pageSize' => 200,
            ],
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
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'birthdate' => $this->birthdate,
            'location_id' => $this->location_id,
            'department_id' => $this->department_id,
            'can_admin' => $this->can_admin,
            'can_visits' => $this->can_visits,
            'can_productivity' => $this->can_productivity,
            'can_requestresources' => $this->can_requestresources,
            'can_managervisits' => $this->can_managervisits,
            'can_managerproductivity' => $this->can_managerproductivity,
            'can_managerrequestresources' => $this->can_managerrequestresources,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'celphone', $this->celphone]);

        return $dataProvider;
    }
}